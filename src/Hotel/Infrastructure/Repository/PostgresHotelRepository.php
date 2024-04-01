<?php declare(strict_types=1);

namespace App\Hotel\Infrastructure\Repository;

use App\Hotel\Domain\Hotel;
use App\Hotel\Domain\Repository\HotelRepository;
use Doctrine\ORM\EntityManagerInterface;

final class PostgresHotelRepository implements HotelRepository
{
    public function __construct(private readonly EntityManagerInterface $em)
    {
    }

    public function save(Hotel $hotel): void
    {
        $this->em->persist($hotel);
        $this->em->flush();
    }
}
