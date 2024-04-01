<?php declare(strict_types=1);

namespace App\Reservation\Domain\ValueObject;

final class Guest
{
    public function __construct(
        private string $name,
        private string $lastname,
        private \DateTimeImmutable $birthdate,
        private string $passport,
        private string $country,
        private int $age
    ){
    }

    public static function from(
        string $name,
        string $lastname,
        \DateTimeImmutable $birthdate,
        string $passport,
        string $country,
        int $age
    ): self {
        return new self($name, $lastname, $birthdate, $passport, $country, $age);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function lastname(): string
    {
        return $this->lastname;
    }

    public function birthdate(): \DateTimeImmutable
    {
        return $this->birthdate;
    }

    public function passport(): string
    {
        return $this->passport;
    }

    public function country(): string
    {
        return $this->country;
    }

    public function age(): int
    {
        return $this->age;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name(),
            'lastName' => $this->lastname(),
            'birthdate' => $this->birthdate()->format('Y-m-d'),
            'passport' => $this->passport(),
            'country' => $this->country(),
            'age' => $this->age(),
        ];
    }
}
