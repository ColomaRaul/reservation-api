<?php declare(strict_types=1);

namespace App\Console;

use App\Hotel\Domain\Service\HotelCreatorService;
use App\Hotel\Domain\Service\HotelRelationProviderCreatorService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class AddHotelDataCommand extends Command
{
    public function __construct(
        private HotelCreatorService $hotelCreatorService,
        private HotelRelationProviderCreatorService $hotelRelationProviderCreatorService,
    ) {
        parent::__construct();
    }

    protected static $defaultName = 'app:load-hotel-data';
    protected static $defaultDescription = 'Load all hotel data';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $hotelData = [
            [
                'id' => '70ce8358-600a-4bad-8ee6-acf46e1fb8db',
                'name' => 'Hotel con ID Externo 36001'
            ],
            [
                'id' => '3cbcd874-a7e0-4bb3-987e-eb36f05b7e7a',
                'name' => 'Hotel con ID Externo 28001'
            ],
            [
                'id' => 'ca385c3b-c2b1-4691-b433-c8cd51883d25',
                'name' => 'Hotel con ID Externo 28003'
            ],
            [
                'id' => '5ab1d247-19ea-4850-9242-2d3ffbbdb58d',
                'name' => 'Hotel con ID Externo 49001'
            ],
        ];

        $hotelProviderRelationData = [
            [
                'hotelId' => '70ce8358-600a-4bad-8ee6-acf46e1fb8db',
                'providerId' => '899406cc-f757-42d5-8cd8-165fb5e57a60',
                'providerHotelCode' => '36001'
            ],
            [
                'hotelId' => '3cbcd874-a7e0-4bb3-987e-eb36f05b7e7a',
                'providerId' => '899406cc-f757-42d5-8cd8-165fb5e57a60',
                'providerHotelCode' => '28001'
            ],
            [
                'hotelId' => 'ca385c3b-c2b1-4691-b433-c8cd51883d25',
                'providerId' => '899406cc-f757-42d5-8cd8-165fb5e57a60',
                'providerHotelCode' => '28003'
            ],
            [
                'hotelId' => '5ab1d247-19ea-4850-9242-2d3ffbbdb58d',
                'providerId' => '899406cc-f757-42d5-8cd8-165fb5e57a60',
                'providerHotelCode' => '49001'
            ],
        ];

        foreach ($hotelData as $hotel) {
            $this->hotelCreatorService->from($hotel['id'], $hotel['name']);
        }

        foreach ($hotelProviderRelationData as $hotelProviderRelation) {
            $this->hotelRelationProviderCreatorService->from(
                $hotelProviderRelation['hotelId'],
                $hotelProviderRelation['providerId'],
                $hotelProviderRelation['providerHotelCode'],
            );
        }

        return Command::SUCCESS;
    }
}
