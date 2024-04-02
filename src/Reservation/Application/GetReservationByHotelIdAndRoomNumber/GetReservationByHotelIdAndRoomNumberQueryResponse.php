<?php declare(strict_types=1);

namespace App\Reservation\Application\GetReservationByHotelIdAndRoomNumber;

use App\Reservation\Domain\Reservation;
use App\Shared\Application\Query\QueryResponseInterface;

final class GetReservationByHotelIdAndRoomNumberQueryResponse implements QueryResponseInterface
{
    public function __construct(private readonly array $params)
    {
    }

    public function response(): array
    {
        return $this->params;
    }

    public static function fromArray(array $params): self
    {
        return new self($params);
    }

    public static function fromReservation(Reservation $reservation): self
    {
        return new self($reservation->toArray());
    }
}
