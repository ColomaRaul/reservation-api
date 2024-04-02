<?php declare(strict_types=1);

namespace App\Reservation\Domain\Model;

final class ReservationProviderBookingPax
{
    public function __construct(
        private readonly int $adults,
        private readonly int $kids,
        private readonly int $babies,
    ) {
    }

    public static function from(int $adults, int $kids, int $babies): self
    {
        return new self($adults, $kids, $babies);
    }

    public function adults(): int
    {
        return $this->adults;
    }

    public function kids(): int
    {
        return $this->kids;
    }

    public function babies(): int
    {
        return $this->babies;
    }

    public function toArray(): array
    {
        return [
            'adults' => $this->adults(),
            'kids' => $this->kids(),
            'babies' => $this->babies()
        ];
    }
}
