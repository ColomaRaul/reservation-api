<?php declare(strict_types=1);

namespace App\Reservation\Application\GetReservationByHotelIdAndRoomNumber;

use App\Shared\Application\Query\QueryInterface;
use App\Shared\Domain\ValueObject\Uuid;

final class GetReservationByHotelIdAndRoomNumberQuery implements QueryInterface
{
    public function __construct(private readonly Uuid $hotelId, private readonly string $roomNumber)
    {
    }

    public static function from(string $hotelId, string $roomNumber): self
    {
        return new self(Uuid::from($hotelId), $roomNumber);
    }

    public function hotelId(): Uuid
    {
        return $this->hotelId;
    }

    public function roomNumber(): string
    {
        return $this->roomNumber;
    }
}
