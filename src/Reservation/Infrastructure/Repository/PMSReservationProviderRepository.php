<?php declare(strict_types=1);

namespace App\Reservation\Infrastructure\Repository;

use App\Reservation\Domain\Model\ReservationProviderData;
use App\Reservation\Domain\Repository\ReservationProviderRepository;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class PMSReservationProviderRepository implements ReservationProviderRepository
{
    private const PMS_FAKE_TESTS_URL = 'sta/pms-faker/stay/test/pms';

    public function __construct(private HttpClientInterface $pmsClient)
    {
    }

    public function byTimestamp(string $timestamp = '0'): ReservationProviderData
    {
        try {
            $response = $this->pmsClient->request(
                'GET',
                self::PMS_FAKE_TESTS_URL,
                [
                    'query' => [
                        'ts' => $timestamp
                    ]
                ],
            );

            return PMSReservationProviderRepositoryMapper::map($response->toArray());
        } catch (\Exception $e) {
            return PMSReservationProviderRepositoryMapper::map([]);
        }
    }
}
