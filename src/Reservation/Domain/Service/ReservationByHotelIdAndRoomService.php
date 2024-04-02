<?php declare(strict_types=1);

namespace App\Reservation\Domain\Service;

use App\Hotel\Domain\Repository\HotelProviderRelationRepository;
use App\Hotel\Domain\Repository\HotelRepository;
use App\Reservation\Domain\Repository\ReservationRepository;
use App\Reservation\Domain\Reservation;
use App\Shared\Domain\ValueObject\Uuid;

final class ReservationByHotelIdAndRoomService
{
    public function __construct(
        private ReservationRepository $reservationRepository,
        private HotelProviderRelationRepository $hotelProviderRelationRepository,
    ) {
    }

    public function reservationByHotelIdAndRoomNumber(Uuid $hotelId, string $roomNumber): ?Reservation
    {
        // TODO update provider id
        $providerId = Uuid::from('899406cc-f757-42d5-8cd8-165fb5e57a60');

        $hotelProviderRelation = $this->hotelProviderRelationRepository->byHotelIdAndProviderId($hotelId, $providerId);

        if (null === $hotelProviderRelation) {
            return null;
        }

        $reservation = $this->reservationRepository->byHotelIdAndRoomNumber($hotelId, $roomNumber);

        if (null !== $reservation) {
            return $reservation;
        }

        // Check in the web again

        return null;
    }
}
