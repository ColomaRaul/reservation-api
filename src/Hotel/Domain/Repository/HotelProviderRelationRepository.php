<?php declare(strict_types=1);

namespace App\Hotel\Domain\Repository;

use App\Hotel\Domain\HotelProviderRelation;
use App\Shared\Domain\ValueObject\Uuid;

interface HotelProviderRelationRepository
{
    public function save(HotelProviderRelation $hotelProviderRelation): void;

    public function byHotelIdAndProviderId(Uuid $hotelId, Uuid $providerId): ?HotelProviderRelation;

    public function byProviderCode(string $providerCode): ?HotelProviderRelation;

    public function all(): array;
}
