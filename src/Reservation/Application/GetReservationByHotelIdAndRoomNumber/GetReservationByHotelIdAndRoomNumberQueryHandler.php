<?php declare(strict_types=1);

namespace App\Reservation\Application\GetReservationByHotelIdAndRoomNumber;

use App\Reservation\Domain\Service\ReservationByHotelIdAndRoomService;
use App\Shared\Application\Query\QueryResponseInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class GetReservationByHotelIdAndRoomNumberQueryHandler
{
    public function __construct(private ReservationByHotelIdAndRoomService $service)
    {
    }

    public function __invoke(GetReservationByHotelIdAndRoomNumberQuery $query): QueryResponseInterface
    {
        $reservation = $this->service->reservationByHotelIdAndRoomNumber($query->hotelId(), $query->roomNumber());

        return GetReservationByHotelIdAndRoomNumberQueryResponse::from(['hotelId' => $query->hotelId()->value(), 'roomNumber' => $query->roomNumber()]);
    }
}
