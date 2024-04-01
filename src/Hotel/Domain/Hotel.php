<?php declare(strict_types=1);

namespace App\Hotel\Domain;

use App\Shared\Domain\ValueObject\Uuid;

final class Hotel
{
    public function __construct(
        private readonly Uuid $id,
        private readonly string $name,
    ) {
    }

    public static function from(
        Uuid $id,
        string $name,
    ): self {
        return new self($id, $name);
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }
}
