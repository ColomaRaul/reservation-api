<?php declare(strict_types=1);

namespace App\Reservation\Domain\Service;

use App\Hotel\Domain\Repository\HotelProviderRelationRepository;
use App\Reservation\Domain\Model\ReservationProvider;
use App\Reservation\Domain\Model\ReservationProviderBookingGuest;
use App\Reservation\Domain\Model\ReservationProviderData;
use App\Reservation\Domain\Repository\ReservationProviderRepository;
use App\Reservation\Domain\Repository\ReservationRepository;
use App\Reservation\Domain\Reservation;
use App\Reservation\Domain\ValueObject\Guest;
use App\Reservation\Domain\ValueObject\GuestCollection;
use App\Shared\Domain\ValueObject\Uuid;

final class ImportAllActiveReservationsService
{
    public function __construct(
        private ReservationProviderRepository $reservationProviderRepository,
        private ReservationRepository         $reservationRepository,
        private HotelProviderRelationRepository $hotelProviderRelationRepository,
    ) {
    }

    public function import(): ReservationProviderData
    {
        $data = $this->reservationProviderRepository->byTimestamp();

        $allHotelProviderRelation = [];
        foreach ($this->hotelProviderRelationRepository->all() as $hotelProviderRelation) {
            $allHotelProviderRelation[$hotelProviderRelation->providerHotelCode()] = $hotelProviderRelation;
        }

        /** @var ReservationProvider $reservationProvider */
        foreach ($data->bookings() as $reservationProvider) {
            $hotelRelationProvider = $allHotelProviderRelation[$reservationProvider->hotelId()];
            $guestCollection = $this->createGuestCollection($reservationProvider->guest());

            $reservation = Reservation::from(
                Uuid::random(),
                $hotelRelationProvider->hotelId(),
                $reservationProvider->booking()->locator(),
                $reservationProvider->booking()->room(),
                $reservationProvider->booking()->checkIn(),
                $reservationProvider->booking()->checkOut(),
                $reservationProvider->created(),
                $guestCollection,
            );

            $this->reservationRepository->save($reservation);
        }

        return $data;
    }

    public function createGuestCollection(ReservationProviderBookingGuest $reservationProviderBookingGuest): GuestCollection
    {
        $guest = Guest::from(
            $reservationProviderBookingGuest->name(),
            $reservationProviderBookingGuest->lastname(),
            $reservationProviderBookingGuest->birthdate(),
            $reservationProviderBookingGuest->passport(),
            $reservationProviderBookingGuest->country(),
        );

        return GuestCollection::from([$guest]);
    }
}
