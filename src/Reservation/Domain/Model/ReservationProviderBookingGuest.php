<?php declare(strict_types=1);

namespace App\Reservation\Domain\Model;

final class ReservationProviderBookingGuest
{
    public function __construct(
        private string $name,
        private string $lastname,
        private \DateTimeImmutable $birthdate,
        private string $passport,
        private string $country,
    ) {
    }

    public static function from(
        string $name,
        string $lastname,
        \DateTimeImmutable $birthdate,
        string $passport,
        string $country
    ): self {
        return new self($name, $lastname, $birthdate, $passport, $country);
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

    public function toArray(): array
    {
        return [
            'name' => $this->name(),
            'lastname' => $this->lastname(),
            'birthdate' => $this->birthdate()->format('Y-m-d'),
            'passport' => $this->passport(),
            'country' => $this->country(),
        ];
    }
}
