<?php declare(strict_types=1);

namespace App\Shared\Infrastructure\Api;

use Symfony\Component\HttpFoundation\JsonResponse;

final class HomepageController extends AbstractApiController
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse([
            'title' => 'Reservation API testing',
            'author' => 'Raúl Coloma Bonifacio'
        ]);
    }
}
