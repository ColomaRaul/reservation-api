<?php declare(strict_types=1);

namespace App\Reservation\Domain\Model;

use App\Shared\Domain\ValueObject\Collection;

final class ReservationProviderBookingCollection extends Collection
{
    private function __construct(array $items = [])
    {
        foreach ($items as $item) {
            if (!$item instanceof ReservationProvider) {
                throw new \InvalidArgumentException('Object invalid class name, required: '. ReservationProvider::class);
            }

            $this->add($item);
        }
    }

    public static function from(array $items): self
    {
        return new self($items);
    }

    public function add(ReservationProvider $guest): void
    {
        $this->items[] = $guest;
    }

    public function toArray(): array
    {
        return array_map(function(ReservationProvider $booking) {
            return $booking->toArray();
        }, $this->items);
    }
}
