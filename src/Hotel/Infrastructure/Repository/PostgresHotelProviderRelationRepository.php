<?php declare(strict_types=1);

namespace App\Hotel\Infrastructure\Repository;

use App\Hotel\Domain\HotelProviderRelation;
use App\Hotel\Domain\Repository\HotelProviderRelationRepository;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\ORM\EntityManagerInterface;

final class PostgresHotelProviderRelationRepository implements HotelProviderRelationRepository
{
    public function __construct(private readonly EntityManagerInterface $em)
    {
    }

    public function save(HotelProviderRelation $hotelProviderRelation): void
    {
        $this->em->persist($hotelProviderRelation);
        $this->em->flush();
    }

    public function byHotelIdAndProviderId(Uuid $hotelId, Uuid $providerId): ?HotelProviderRelation
    {
        return $this->em->getRepository(HotelProviderRelation::class)->findOneBy([
            'hotelId' => $hotelId->value(),
            'providerId' => $providerId->value(),
        ]);
    }

    public function byProviderCode(string $providerCode): ?HotelProviderRelation
    {
        return $this->em->getRepository(HotelProviderRelation::class)->findOneBy([
            'providerHotelCode' => $providerCode,
        ]);
    }

    public function all(): array
    {
        return $this->em->getRepository(HotelProviderRelation::class)->findAll();
    }
}
