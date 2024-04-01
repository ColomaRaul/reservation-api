<?php declare(strict_types=1);

namespace App\Reservation\Infrastructure\Orm;

use App\Reservation\Domain\ValueObject\GuestCollection;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\JsonType;

final class ReservationGuestsType extends JsonType
{
    public function getName(): string
    {
        return self::class;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): GuestCollection
    {
        return GuestCollection::from(json_decode($value, true));
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        return json_encode($value->toArray());
    }
}
