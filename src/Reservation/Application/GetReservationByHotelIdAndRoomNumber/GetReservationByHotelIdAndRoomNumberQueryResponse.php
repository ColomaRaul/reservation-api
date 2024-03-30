<?php declare(strict_types=1);

namespace App\Reservation\Application\GetReservationByHotelIdAndRoomNumber;

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

    public static function from(array $params): self
    {
        return new self($params);
    }
}
