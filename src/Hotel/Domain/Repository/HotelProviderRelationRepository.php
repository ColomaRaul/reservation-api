<?php declare(strict_types=1);

namespace App\Hotel\Domain\Repository;

use App\Hotel\Domain\HotelProviderRelation;

interface HotelProviderRelationRepository
{
    public function save(HotelProviderRelation $hotelProviderRelation): void;
}
