<?php declare(strict_types=1);

namespace App\Reservation\Domain\Model;

final class ReservationProviderData
{
    public function __construct(
        private readonly ReservationProviderBookingCollection $bookings,
        private readonly int                                  $total
    ) {
    }

    public static function from(ReservationProviderBookingCollection $bookings, int $total): self
    {
        return new self($bookings, $total);
    }

    public function bookings(): ReservationProviderBookingCollection
    {
        return $this->bookings;
    }

    public function total(): int
    {
        return $this->total;
    }

    public function toArray(): array
    {
        return [
            'bookings' => $this->bookings()->toArray(),
            'total' => $this->total(),
        ];
    }
}
