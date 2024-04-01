<?php declare(strict_types=1);

namespace App\Reservation\Infrastructure\Repository;

use App\Reservation\Domain\Repository\ReservationRepository;
use App\Reservation\Domain\Reservation;
use Doctrine\ORM\EntityManagerInterface;

final class PostgresReservationRepository implements ReservationRepository
{
    public function __construct(private readonly EntityManagerInterface $em)
    {
    }

    public function save(Reservation $reservation): void
    {
        $this->em->persist($reservation);
        $this->em->flush();
    }
}
