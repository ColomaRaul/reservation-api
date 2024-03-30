<?php declare(strict_types=1);

namespace App\Tests\Health\Application\GetHealth;

use App\Health\Application\GetHealth\GetHealthQuery;
use App\Health\Application\GetHealth\GetHealthQueryHandler;
use App\Health\Application\GetHealth\GetHealthQueryResponse;
use PHPUnit\Framework\TestCase;

final class GetHealthQueryHandlerTest extends TestCase
{
    public function test_given_health_handler_when_get_health_then_return_ok(): void
    {
        $handler = new GetHealthQueryHandler();
        $result = ($handler)(GetHealthQuery::from());

        $this->assertInstanceOf(GetHealthQueryResponse::class, $result);
        $this->assertEquals(['value' => 'All OK'], $result->response());
    }
}
