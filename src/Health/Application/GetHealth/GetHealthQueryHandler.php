<?php declare(strict_types=1);

namespace App\Health\Application\GetHealth;

use App\Shared\Application\Query\QueryResponseInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class GetHealthQueryHandler
{
    public function __invoke(GetHealthQuery $query): QueryResponseInterface
    {
        return GetHealthQueryResponse::from('All OK');
    }
}
