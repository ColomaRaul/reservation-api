<?php declare(strict_types=1);

namespace App\Reservation\Infrastructure\Repository;

use App\Hotel\Domain\HotelProviderRelation;
use App\Hotel\Domain\Repository\HotelProviderRelationRepository;
use App\Reservation\Domain\Event\NewReservationProviderFoundedEvent;
use App\Reservation\Domain\Model\ReservationProvider;
use App\Reservation\Domain\Repository\ReservationProviderRepository;
use App\Reservation\Domain\Repository\ReservationRepository;
use App\Reservation\Domain\Reservation;
use App\Reservation\Domain\ValueObject\Guest;
use App\Reservation\Domain\ValueObject\GuestCollection;
use App\Shared\Domain\ValueObject\Uuid;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class ReservationRepositoryDecorator implements ReservationRepository
{
    public function __construct(
        private readonly ReservationRepository $dbRepository,
        private readonly ReservationProviderRepository $reservationProviderRepository,
        private readonly EventDispatcherInterface $eventDispatcher
    ) {
    }

    public function save(Reservation $reservation): void
    {
        $this->dbRepository->save($reservation);
    }

    public function byHotelAndRoomNumber(string $roomNumber, HotelProviderRelation $hotelProviderRelation): ?Reservation
    {
        $reservation = $this->dbRepository->byHotelAndRoomNumber($roomNumber, $hotelProviderRelation);

        if (null !== $reservation) {
            return $reservation;
        }

        $now = new \DateTimeImmutable();
        $lastTwoWeeks = $now->modify('-2 week');
        $reservations = $this->reservationProviderRepository->byTimestamp((string)$lastTwoWeeks->getTimestamp());

        $reservation = null;

        /** @var ReservationProvider $reservationProvider */
        foreach ($reservations->bookings() as $reservationProvider) {
            if ($reservationProvider->hotelId() === $hotelProviderRelation->providerHotelCode() &&
                $reservationProvider->booking()->room() === $roomNumber
            ) {
                $guestCollection = GuestCollection::from([Guest::from(
                    $reservationProvider->guest()->name(),
                    $reservationProvider->guest()->lastname(),
                    $reservationProvider->guest()->birthdate(),
                    $reservationProvider->guest()->passport(),
                    $reservationProvider->guest()->country()
                )]);

                $reservation = Reservation::from(
                    Uuid::random(),
                    $hotelProviderRelation->hotelId(),
                    $reservationProvider->booking()->locator(),
                    $reservationProvider->booking()->room(),
                    $reservationProvider->booking()->checkIn(),
                    $reservationProvider->booking()->checkOut(),
                    $reservationProvider->created(),
                    $guestCollection
                );
            }

            $this->eventDispatcher->dispatch(NewReservationProviderFoundedEvent::from($reservationProvider));
        }

        return $reservation;
    }

    public function byLocator(string $locator): ?Reservation
    {
        return $this->dbRepository->byLocator($locator);
    }
}
