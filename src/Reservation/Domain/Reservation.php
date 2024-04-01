<?php declare(strict_types=1);

namespace App\Reservation\Domain;

use App\Reservation\Domain\ValueObject\GuestCollection;
use App\Shared\Domain\ValueObject\Uuid;

final class Reservation
{
    public function __construct(
        private readonly Uuid $id,
        private readonly Uuid $hotelId,
        private string $locator,
        private string $roomNumber,
        private \DateTimeImmutable $checkIn,
        private \DateTimeImmutable $checkOut,
        private GuestCollection $guests
    ) {
    }

    public static function from(
        Uuid $id,
        Uuid $hotelId,
        string $locator,
        string $roomNumber,
        \DateTimeImmutable $checkIn,
        \DateTimeImmutable $checkOut,
        GuestCollection $guests
    ): self {
        return new self(
            $id,
            $hotelId,
            $locator,
            $roomNumber,
            $checkIn,
            $checkOut,
            $guests
        );
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function hotelId(): Uuid
    {
        return $this->hotelId;
    }

    public function locator(): string
    {
        return $this->locator;
    }

    public function roomNumber(): string
    {
        return $this->roomNumber;
    }

    public function checkIn(): \DateTimeImmutable
    {
        return $this->checkIn;
    }

    public function checkOut(): \DateTimeImmutable
    {
        return $this->checkOut;
    }

    public function guests(): GuestCollection
    {
        return $this->guests;
    }
}
