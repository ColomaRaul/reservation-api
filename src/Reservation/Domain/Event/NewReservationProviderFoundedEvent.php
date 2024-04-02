<?php declare(strict_types=1);

namespace App\Reservation\Domain\Event;

use App\Reservation\Domain\Model\ReservationProvider;
use Symfony\Contracts\EventDispatcher\Event;

final class NewReservationProviderFoundedEvent extends Event
{
    public function __construct(
        private readonly ReservationProvider $reservationProvider)
    {
    }

    public static function from(ReservationProvider $reservationProvider): self
    {
        return new self($reservationProvider);
    }

    public function reservationProvider(): ReservationProvider
    {
        return $this->reservationProvider;
    }
}
