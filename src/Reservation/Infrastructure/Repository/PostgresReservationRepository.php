<?php declare(strict_types=1);

namespace App\Reservation\Infrastructure\Repository;

use App\Hotel\Domain\HotelProviderRelation;
use App\Reservation\Domain\Repository\ReservationRepository;
use App\Reservation\Domain\Reservation;
use App\Shared\Domain\ValueObject\Uuid;
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

    public function byHotelAndRoomNumber(string $roomNumber, HotelProviderRelation $hotelProviderRelation): ?Reservation
    {
        return $this->em->getRepository(Reservation::class)->findOneBy([
            'hotelId' => $hotelProviderRelation->hotelId()->value(),
            'roomNumber' => $roomNumber,
        ]);
    }

    public function byLocator(string $locator): ?Reservation
    {
        return $this->em->getRepository(Reservation::class)->findOneBy([
            'locator' => $locator
        ]);
    }
}
