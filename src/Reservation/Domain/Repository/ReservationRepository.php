<?php declare(strict_types=1);

namespace App\Reservation\Domain\Repository;

use App\Reservation\Domain\Reservation;

interface ReservationRepository
{
    public function save(Reservation $reservation): void;
}
