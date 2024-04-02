<?php declare(strict_types=1);

namespace App\Console;

use App\Reservation\Domain\Service\ImportAllActiveReservationsService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class ImportAllReservationsFromProviderCommand extends Command
{
    public function __construct(private ImportAllActiveReservationsService $service)
    {
        parent::__construct();
    }

    protected static $defaultName = 'app:load-reservation-data';
    protected static $defaultDescription = 'Load reservation data from provider';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $result = $this->service->import();

        $output->writeln('Total: '. $result->total());

        return Command::SUCCESS;
    }
}
