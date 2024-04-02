<?php declare(strict_types=1);

namespace App\Reservation\Domain\Service;

use App\Hotel\Domain\Repository\HotelProviderRelationRepository;
use App\Reservation\Domain\Model\ReservationProvider;
use App\Reservation\Domain\Repository\ReservationRepository;
use App\Reservation\Domain\Reservation;
use App\Reservation\Domain\ValueObject\Guest;
use App\Reservation\Domain\ValueObject\GuestCollection;
use App\Shared\Domain\ValueObject\Uuid;

final class ReservationCreatorService
{
    public function __construct(
        private readonly ReservationRepository $reservationRepository,
        private readonly HotelProviderRelationRepository $hotelProviderRelationRepository,
    ) {
    }

    public function createFromReservationProvider(ReservationProvider $reservationProvider): void
    {
        $hotelRelationProvider = $this->hotelProviderRelationRepository->byProviderCode($reservationProvider->hotelId());

        if (null === $hotelRelationProvider) {
            return;
        }

        $reservation = $this->reservationRepository->byLocator($reservationProvider->booking()->locator());

        if (null !== $reservation) {
            return;
        }

        $guestCollection = GuestCollection::from([Guest::from(
            $reservationProvider->guest()->name(),
            $reservationProvider->guest()->lastname(),
            $reservationProvider->guest()->birthdate(),
            $reservationProvider->guest()->passport(),
            $reservationProvider->guest()->country()
        )]);

        $reservation = Reservation::from(
            Uuid::random(),
            $hotelRelationProvider->hotelId(),
            $reservationProvider->booking()->locator(),
            $reservationProvider->booking()->room(),
            $reservationProvider->booking()->checkIn(),
            $reservationProvider->booking()->checkOut(),
            $reservationProvider->created(),
            $guestCollection,
        );

        $this->reservationRepository->save($reservation);
    }
}
