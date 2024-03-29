<?php declare(strict_types=1);

namespace App\Shared\Infrastructure\Api;

use App\Shared\Application\Query\QueryInterface;
use App\Shared\Application\Query\QueryResponseInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

abstract class AbstractApiController extends AbstractController
{
    use HandleTrait;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    protected function ask(QueryInterface $query): QueryResponseInterface
    {
        try {
            return $this->handle($query);
        } catch (HandlerFailedException $e) {
            while ($e instanceof HandlerFailedException) {
                $e = $e->getPrevious();
            }

            throw $e;
        }
    }
}
