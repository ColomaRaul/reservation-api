<?php declare(strict_types=1);

namespace App\Reservation\Domain\Model;

final class ReservationProviderBooking
{
    public function __construct(
        private string                        $locator,
        private string                        $room,
        private \DateTimeImmutable            $checkIn,
        private \DateTimeImmutable            $checkOut,
        private ReservationProviderBookingPax $pax,
    ) {
    }

    public static function from(
        string $locator,
        string $room,
        \DateTimeImmutable $checkIn,
        \DateTimeImmutable $checkOut,
        ReservationProviderBookingPax $pax
    ): self {
        return new self($locator, $room, $checkIn, $checkOut, $pax);
    }

    public function locator(): string
    {
        return $this->locator;
    }

    public function room(): string
    {
        return $this->room;
    }

    public function checkIn(): \DateTimeImmutable
    {
        return $this->checkIn;
    }

    public function checkOut(): \DateTimeImmutable
    {
        return $this->checkOut;
    }

    public function pax(): ReservationProviderBookingPax
    {
        return $this->pax;
    }

    public function toArray(): array
    {
        return [
            'locator' => $this->locator(),
            'room' => $this->room(),
            'check_in' => $this->checkIn()->format('Y-m-d'),
            'check_out' => $this->checkOut()->format('Y-m-d'),
            'pax' => $this->pax()->toArray(),
        ];
    }
}
