<?php declare(strict_types=1);

namespace App\Reservation\Domain\Model;

final class ReservationProvider
{
    public function __construct(
        private string                          $hotelId,
        private string                          $hotelName,
        private ReservationProviderBookingGuest $guest,
        private ReservationProviderBooking      $booking,
        private \DateTimeImmutable              $created,
        private string                          $signature,
    ) {
    }

    public static function from(
        string                          $hotelId,
        string                          $hotelName,
        ReservationProviderBookingGuest $guest,
        ReservationProviderBooking      $booking,
        \DateTimeImmutable              $created,
        string                          $signature
    ): self {
        return new self($hotelId, $hotelName, $guest, $booking, $created, $signature);
    }

    public function hotelId(): string
    {
        return $this->hotelId;
    }

    public function hotelName(): string
    {
        return $this->hotelName;
    }

    public function guest(): ReservationProviderBookingGuest
    {
        return $this->guest;
    }

    public function booking(): ReservationProviderBooking
    {
        return $this->booking;
    }

    public function created(): \DateTimeImmutable
    {
        return $this->created;
    }

    public function signature(): string
    {
        return $this->signature;
    }

    public function toArray(): array
    {
        return [
            'hotel_id' => $this->hotelId(),
            'hotel_name' => $this->hotelName(),
            'guest' => $this->guest()->toArray(),
            'booking' => $this->booking()->toArray(),
            'created' => $this->created()->format('Y-m-d'),
            'signature' => $this->signature(),
        ];
    }
}
