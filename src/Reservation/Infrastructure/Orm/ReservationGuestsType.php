<?php declare(strict_types=1);

namespace App\Reservation\Infrastructure\Orm;

use App\Reservation\Domain\ValueObject\Guest;
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
        $guestCollection = GuestCollection::from([]);

        foreach (json_decode($value, true) as $item) {
            $guestCollection->add(
                Guest::from(
                    $item['name'],
                    $item['lastName'],
                    \DateTimeImmutable::createFromFormat('Y-m-d', $item['birthdate']),
                    $item['passport'],
                    $item['country'],
                )
            );
        }

        return $guestCollection;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        return json_encode($value->toArray());
    }
}
