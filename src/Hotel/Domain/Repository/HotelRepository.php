<?php declare(strict_types=1);

namespace App\Hotel\Domain\Repository;

use App\Hotel\Domain\Hotel;

interface HotelRepository
{
    public function save(Hotel $hotel): void;
}
