<?php declare(strict_types=1);

namespace App\Reservation\Infrastructure\External;

use App\Reservation\Domain\Model\ReservationProvider;
use App\Reservation\Domain\Model\ReservationProviderBooking;
use App\Reservation\Domain\Model\ReservationProviderBookingPax;
use App\Reservation\Domain\Model\ReservationProviderBookingCollection;
use App\Reservation\Domain\Model\ReservationProviderBookingGuest;
use App\Reservation\Domain\Model\ReservationProviderData;

final class PMSReservationProviderRepositoryMapper
{
    public static function map(array $items): ReservationProviderData
    {
        $total = $items['total'] ?? 0;
        $bookings = ReservationProviderBookingCollection::from([]);
        $itemsBookings = $items['bookings'] ?? [];

        foreach ($itemsBookings as $item) {
            $bookingGuest = ReservationProviderBookingGuest::from(
                $item['guest']['name'],
                $item['guest']['lastname'],
                \DateTimeImmutable::createFromFormat('Y-m-d', $item['guest']['birthdate']),
                $item['guest']['passport'],
                $item['guest']['country'],
            );
            $bookingBookingPax = ReservationProviderBookingPax::from(
                (int)$item['booking']['pax']['adults'],
                (int)$item['booking']['pax']['kids'],
                (int)$item['booking']['pax']['babies'],
            );
            $bookingBooking = ReservationProviderBooking::from(
                $item['booking']['locator'],
                $item['booking']['room'],
                \DateTimeImmutable::createFromFormat('Y-m-d', $item['booking']['check_in']),
                \DateTimeImmutable::createFromFormat('Y-m-d', $item['booking']['check_out']),
                $bookingBookingPax,
            );
            $bookingObject = ReservationProvider::from(
                $item['hotel_id'],
                $item['hotel_name'],
                $bookingGuest,
                $bookingBooking,
                \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $item['created']),
                $item['signature'],
            );

            $bookings->add($bookingObject);
        }

        return ReservationProviderData::from($bookings, $total);
    }
}
