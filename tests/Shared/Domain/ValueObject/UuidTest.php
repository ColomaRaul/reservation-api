<?php declare(strict_types=1);

namespace App\Tests\Shared\Domain\ValueObject;


use App\Shared\Domain\ValueObject\Uuid;
use PHPUnit\Framework\TestCase;

final class UuidTest extends TestCase
{
    public function test_given_correct_uuid_when_create_then_return_value(): void
    {
        $uuidValueObject = Uuid::from('cf63459b-7d71-4cf7-bccd-0ff843aa76b3');

        $this->assertInstanceOf(Uuid::class, $uuidValueObject);
    }

    public function test_given_wrong_uuid_when_create_then_throw_exception(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        Uuid::from('abc1234');
    }
}
