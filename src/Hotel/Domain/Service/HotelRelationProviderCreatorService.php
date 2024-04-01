<?php declare(strict_types=1);

namespace App\Hotel\Domain\Service;

use App\Hotel\Domain\HotelProviderRelation;
use App\Hotel\Domain\Repository\HotelProviderRelationRepository;
use App\Shared\Domain\ValueObject\Uuid;

final class HotelRelationProviderCreatorService
{
    public function __construct(private readonly HotelProviderRelationRepository $repository)
    {
    }

    public function from(string $hotelId, string $providerId, string $providerCode): void
    {
        $hotelProviderRelation = HotelProviderRelation::from(Uuid::from($hotelId), Uuid::from($providerId), $providerCode);

        $this->repository->save($hotelProviderRelation);
    }
}
