<?php declare(strict_types=1);

namespace App\Reservation\Domain\Repository;

use App\Reservation\Domain\Model\ReservationProviderData;

interface ReservationProviderRepository
{
    public function all(): ReservationProviderData;
}
