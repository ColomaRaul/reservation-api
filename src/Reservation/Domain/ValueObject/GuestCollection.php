<?php declare(strict_types=1);

namespace App\Reservation\Domain\ValueObject;

use App\Shared\Domain\ValueObject\Collection;

final class GuestCollection extends Collection
{
    private function __construct(array $items = [])
    {
        foreach ($items as $item) {
            if (!$item instanceof Guest) {
                throw new \InvalidArgumentException('Object invalid class name, required: '. Guest::class);
            }

            $this->add($item);
        }
    }

    public static function from(array $items): self
    {
        return new self($items);
    }

    public function add(Guest $guest): void
    {
        $this->items[] = $guest;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function toArray(): array
    {
        return array_map(function(Guest $guest) {
            return $guest->toArray();
        }, $this->items);
    }
}
