<?php declare(strict_types=1);

namespace App\Health\Infrastructure\Api;

use App\Health\Application\GetHealth\GetHealthQuery;
use App\Shared\Infrastructure\Api\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class HealthController extends AbstractApiController
{
    public function __invoke(): JsonResponse
    {
        try {
            $result = $this->ask(GetHealthQuery::from());

            return new JsonResponse([
                'data' => $result->response(),
                'code' => 200,
            ], 200);
        } catch (\Throwable $e) {
            return new JsonResponse($e->getMessage(), 500);
        }
    }
}
