<?php declare(strict_types=1);

namespace App\Reservation\Domain\Repository;

use App\Hotel\Domain\HotelProviderRelation;
use App\Reservation\Domain\Reservation;
use App\Shared\Domain\ValueObject\Uuid;

interface ReservationRepository
{
    public function save(Reservation $reservation): void;

    public function byHotelAndRoomNumber(string $roomNumber, HotelProviderRelation $hotelProviderRelation): ?Reservation;
}
