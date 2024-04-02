<?php declare(strict_types=1);

namespace App\Reservation\Domain\Listener;

use App\Reservation\Domain\Event\NewReservationProviderFoundedEvent;
use App\Reservation\Domain\Model\ReservationProvider;
use App\Reservation\Domain\Service\ReservationCreatorService;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener]
final class NewReservationsFoundedListener
{
    public function __construct(
        private readonly ReservationCreatorService $creatorService
    ){
    }

    #[NoReturn] public function __invoke(NewReservationProviderFoundedEvent $event): void
    {
        $this->creatorService->createFromReservationProvider($event->reservationProvider());
    }
}
