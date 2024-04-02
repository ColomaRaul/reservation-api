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
        private \DateTimeImmutable $created,
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
        \DateTimeImmutable $created,
        GuestCollection $guests
    ): self {
        return new self(
            $id,
            $hotelId,
            $locator,
            $roomNumber,
            $checkIn,
            $checkOut,
            $created,
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

    public function created(): \DateTimeImmutable
    {
        return $this->created;
    }

    public function guests(): GuestCollection
    {
        return $this->guests;
    }

    public function numberOfNights(): int
    {
        $diff = $this->checkOut()->diff($this->checkIn());

        return $diff->d;
    }

    public function totalPax(): int
    {
        return $this->guests()->count();
    }

    public function toArray(): array
    {
        return [
            'bookingId' => $this->id()->value(),
            'hotel' => $this->hotelId()->value(),
            'locator' => $this->locator(),
            'room' => $this->roomNumber(),
            'checkIn' => $this->checkIn->format('Y-m-d'),
            'checkOut' => $this->checkOut->format('Y-m-d'),
            'numberOfNights' => $this->numberOfNights(),
            'totalPax' => $this->totalPax(),
            'guests' => $this->guests->toArray(),
        ];
    }
}
