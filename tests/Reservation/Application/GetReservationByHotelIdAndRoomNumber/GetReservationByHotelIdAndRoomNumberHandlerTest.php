<?php declare(strict_types=1);

namespace App\Tests\Reservation\Application\GetReservationByHotelIdAndRoomNumber;

use App\Reservation\Application\GetReservationByHotelIdAndRoomNumber\GetReservationByHotelIdAndRoomNumberQuery;
use App\Reservation\Application\GetReservationByHotelIdAndRoomNumber\GetReservationByHotelIdAndRoomNumberQueryHandler;
use App\Reservation\Application\GetReservationByHotelIdAndRoomNumber\GetReservationByHotelIdAndRoomNumberQueryResponse;
use App\Reservation\Domain\Reservation;
use App\Reservation\Domain\Service\ReservationByHotelIdAndRoomService;
use App\Reservation\Domain\ValueObject\Guest;
use App\Reservation\Domain\ValueObject\GuestCollection;
use App\Shared\Domain\ValueObject\Uuid;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class GetReservationByHotelIdAndRoomNumberHandlerTest extends TestCase
{
    private GetReservationByHotelIdAndRoomNumberQueryHandler $handler;
    private MockObject $service;

    protected function setUp(): void
    {
        $this->service = $this->createMock(ReservationByHotelIdAndRoomService::class);
        $this->handler = new GetReservationByHotelIdAndRoomNumberQueryHandler($this->service);
    }

    public function test_given_handler_when_get_hotel_id_and_room_number_then_return_same_array(): void
    {
        $id = Uuid::random();
        $hotelId = Uuid::random();
        $checkIn = new \DateTimeImmutable();
        $checkOut = new \DateTimeImmutable();
        $checkOut = $checkOut->modify('+2 day');
        $created = new \DateTimeImmutable();
        $this->service->expects($this->once())->method('reservationByHotelIdAndRoomNumber')->willReturn(
            Reservation::from(
                $id,
                $hotelId,
                'locator-test',
                '123',
                $checkIn,
                $checkOut,
                $created,
                GuestCollection::from([
                    Guest::from(
                        'John',
                        'Doe',
                        new \DateTimeImmutable('1990-02-20'),
                        'passport-test',
                        'ES'
                    )
                ])
            )
        );
        $result = ($this->handler)(GetReservationByHotelIdAndRoomNumberQuery::from('70ce8358-600a-4bad-8ee6-acf46e1fb8db', '123'));

        $this->assertInstanceOf(GetReservationByHotelIdAndRoomNumberQueryResponse::class, $result);
        $this->assertEquals([
            'bookingId' => $id->value(),
            'hotel' => $hotelId->value(),
            'locator' => 'locator-test',
            'room' => '123',
            'checkIn' => $checkIn->format('Y-m-d'),
            'checkOut' => $checkOut->format('Y-m-d'),
            'numberOfNights' => 2,
            'totalPax' => 1,
            'guests' => [
                [
                    'name' => 'John',
                    'lastname' => 'Doe',
                    'birthdate' => '1990-02-20',
                    'passport' => 'passport-test',
                    'country' => 'ES',
                    'age' => 34,
                ]
            ]
        ], $result->response());
    }
}
