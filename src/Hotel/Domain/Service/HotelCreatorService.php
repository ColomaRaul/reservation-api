<?php declare(strict_types=1);

namespace App\Hotel\Domain\Service;

use App\Hotel\Domain\Hotel;
use App\Hotel\Domain\Repository\HotelRepository;
use App\Shared\Domain\ValueObject\Uuid;

final class HotelCreatorService
{
    public function __construct(private readonly HotelRepository $repository)
    {
    }

    public function from(string $uuid, string $name): void
    {
        $hotel = Hotel::from(Uuid::from($uuid), $name);

        $this->repository->save($hotel);
    }
}
