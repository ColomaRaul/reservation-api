<?php declare(strict_types=1);

namespace App\Health\Application\GetHealth;

use App\Shared\Application\Query\QueryResponseInterface;

final class GetHealthQueryResponse implements QueryResponseInterface
{
    public function __construct(private readonly string $value)
    {
    }

    public function response(): array
    {
        return ['value' => $this->value];
    }

    public static function from(string $value): self
    {
        return new self($value);
    }
}
