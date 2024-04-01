<?php declare(strict_types=1);

namespace App\Reservation\Domain\Service;

use App\Reservation\Domain\Repository\ReservationRepository;
use App\Reservation\Domain\Reservation;
use App\Reservation\Domain\ValueObject\Guest;
use App\Reservation\Domain\ValueObject\GuestCollection;
use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Uuid;

final class ReservationCreatorService
{
    public function __construct(private ReservationRepository $repository)
    {
    }

    public function from(
        string $id,
        string $hotelId,
        string $locator,
        string $roomNumber,
        string $checkIn,
        string $checkOut,
        array $guests
    ): void {
        $guestCollection = [];
        foreach ($guests as $guest) {
            $guestCollection[] = Guest::from(
                $guest['name'],
                $guest['lastname'],
                \DateTimeImmutable::createFromFormat('Y-m-d', $guest['birthdate']),
                $guest['passport'],
                $guest['country'],
                $guest['age'],
            );
        }

        $reservation = Reservation::from(
            Uuid::from($id),
            Uuid::from($hotelId),
            $locator,
            $roomNumber,
            \DateTimeImmutable::createFromFormat('Y-m-d', $checkIn),
            \DateTimeImmutable::createFromFormat('Y-m-d', $checkOut),
            GuestCollection::from($guestCollection)
        );

        $this->repository->save($reservation);
    }
}
