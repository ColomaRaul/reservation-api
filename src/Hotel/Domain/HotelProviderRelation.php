<?php declare(strict_types=1);

namespace App\Hotel\Domain;

use App\Shared\Domain\ValueObject\Uuid;

final class HotelProviderRelation
{
    public function __construct(
        private readonly Uuid $hotelId,
        private readonly Uuid $providerId,
        private readonly string $providerHotelCode
    ) {
    }

    public static function from(
        Uuid $hotelId,
        Uuid $providerId,
        string $providerHotelCode
    ): self {
        return new self($hotelId, $providerId, $providerHotelCode);
    }

    public function hotelId(): Uuid
    {
        return $this->hotelId;
    }

    public function providerId(): Uuid
    {
        return $this->providerId;
    }

    public function providerHotelCode(): string
    {
        return $this->providerHotelCode;
    }
}
