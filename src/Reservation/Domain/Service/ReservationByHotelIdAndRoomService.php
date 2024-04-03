<?php declare(strict_types=1);

namespace App\Reservation\Domain\Service;

use App\Hotel\Domain\Repository\HotelProviderRelationRepository;
use App\Reservation\Domain\Repository\ReservationRepository;
use App\Reservation\Domain\Reservation;
use App\Shared\Domain\ValueObject\Uuid;

class ReservationByHotelIdAndRoomService
{
    private const DEFAULT_PROVIDER_ID = '899406cc-f757-42d5-8cd8-165fb5e57a60';

    public function __construct(
        private ReservationRepository $reservationRepository,
        private HotelProviderRelationRepository $hotelProviderRelationRepository,
    ) {
    }

    public function reservationByHotelIdAndRoomNumber(Uuid $hotelId, string $roomNumber): ?Reservation
    {
        $providerId = Uuid::from(self::DEFAULT_PROVIDER_ID);

        $hotelProviderRelation = $this->hotelProviderRelationRepository->byHotelIdAndProviderId($hotelId, $providerId);

        if (null === $hotelProviderRelation) {
            return null;
        }

        return $this->reservationRepository->byHotelAndRoomNumber($roomNumber, $hotelProviderRelation);
    }
}
