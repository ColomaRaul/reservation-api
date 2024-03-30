<?php declare(strict_types=1);

namespace App\Reservation\Application\GetReservationByHotelIdAndRoomNumber;

use App\Shared\Application\Query\QueryResponseInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class GetReservationByHotelIdAndRoomNumberQueryHandler
{
    public function __invoke(GetReservationByHotelIdAndRoomNumberQuery $query): QueryResponseInterface
    {
        return GetReservationByHotelIdAndRoomNumberQueryResponse::from(['hotelId' => $query->hotelId()->value(), 'roomNumber' => $query->roomNumber()]);
    }
}
