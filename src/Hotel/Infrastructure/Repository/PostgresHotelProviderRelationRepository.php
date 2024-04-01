<?php declare(strict_types=1);

namespace App\Hotel\Infrastructure\Repository;

use App\Hotel\Domain\HotelProviderRelation;
use App\Hotel\Domain\Repository\HotelProviderRelationRepository;
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
}
