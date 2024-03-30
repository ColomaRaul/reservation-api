<?php declare(strict_types=1);

namespace App\Tests\Reservation\Application\GetReservationByHotelIdAndRoomNumber;

use App\Reservation\Application\GetReservationByHotelIdAndRoomNumber\GetReservationByHotelIdAndRoomNumberQuery;
use App\Reservation\Application\GetReservationByHotelIdAndRoomNumber\GetReservationByHotelIdAndRoomNumberQueryHandler;
use App\Reservation\Application\GetReservationByHotelIdAndRoomNumber\GetReservationByHotelIdAndRoomNumberQueryResponse;
use PHPUnit\Framework\TestCase;

final class GetReservationByHotelIdAndRoomNumberHandlerTest extends TestCase
{
    private GetReservationByHotelIdAndRoomNumberQueryHandler $handler;

    protected function setUp(): void
    {
        $this->handler = new GetReservationByHotelIdAndRoomNumberQueryHandler();
    }

    public function test_given_handler_when_get_hotel_id_and_room_number_then_return_same_array(): void
    {
        $result = ($this->handler)(GetReservationByHotelIdAndRoomNumberQuery::from('70ce8358-600a-4bad-8ee6-acf46e1fb8db', '123'));

        $this->assertInstanceOf(GetReservationByHotelIdAndRoomNumberQueryResponse::class, $result);
        $this->assertEquals(['hotelId' => '70ce8358-600a-4bad-8ee6-acf46e1fb8db', 'roomNumber' => '123'], $result->response());
    }
}
