<?php declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

abstract class Collection implements \IteratorAggregate
{
    protected array $items;

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->items);
    }
}
