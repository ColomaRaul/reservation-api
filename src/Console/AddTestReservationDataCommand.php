<?php declare(strict_types=1);

namespace App\Console;

use App\Reservation\Domain\Service\ReservationCreatorService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class AddTestReservationDataCommand extends Command
{
    public function __construct(private ReservationCreatorService $reservationCreatorService)
    {
        parent::__construct();
    }

    protected static $defaultName = 'app:load-test-reservation-data';
    protected static $defaultDescription = 'Load test reservation data';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $reservationData = [
            [
                'id' =>  'f8273b3c-9b69-4993-885f-2cb00687174a',
                'hotelId' => '70ce8358-600a-4bad-8ee6-acf46e1fb8db',
                'locator' => '649576941E9C7',
                'roomNumber' => '299',
                'checkIn' => '2023-06-23',
                'checkOut' => '2023-06-30',
                'guests' => [
                    [
                        'name' => 'Jesús',
                        'lastname' => 'Delagarza',
                        'birthdate' => '1974-08-05',
                        'passport' => 'MF-1645022-OZ',
                        'country' => 'MF',
                        'age' => 49
                    ],
                ],
            ],
            [
                'id' =>  '9339bb10-90f0-4fd9-8cb1-e22e5e323ec8',
                'hotelId' => '70ce8358-600a-4bad-8ee6-acf46e1fb8db',
                'locator' => '129376941F2A2',
                'roomNumber' => '300',
                'checkIn' => '2023-06-10',
                'checkOut' => '2023-06-13',
                'guests' => [
                    [
                        'name' => 'Jesús',
                        'lastname' => 'Delagarza',
                        'birthdate' => '1974-08-05',
                        'passport' => 'MF-1645022-OZ',
                        'country' => 'MF',
                        'age' => 50
                    ],
                    [
                        'name' => 'Magdalena',
                        'lastname' => 'García',
                        'birthdate' => '1973-10-10',
                        'passport' => 'MF-1645023-PT',
                        'country' => 'MF',
                        'age' => 51
                    ],
                ],
            ],
        ];

        foreach ($reservationData as $data) {
            $this->reservationCreatorService->from(
                $data['id'],
                $data['hotelId'],
                $data['locator'],
                $data['roomNumber'],
                $data['checkIn'],
                $data['checkOut'],
                $data['guests'],
            );
        }

        return Command::SUCCESS;
    }
}
