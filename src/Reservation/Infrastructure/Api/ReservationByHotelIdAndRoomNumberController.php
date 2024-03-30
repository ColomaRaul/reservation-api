<?php declare(strict_types=1);

namespace App\Reservation\Infrastructure\Api;

use App\Reservation\Application\GetReservationByHotelIdAndRoomNumber\GetReservationByHotelIdAndRoomNumberQuery;
use App\Shared\Infrastructure\Api\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class ReservationByHotelIdAndRoomNumberController extends AbstractApiController
{
    private const HOTEL_ID_PARAM = 'hotelId';
    private const ROOM_NUMBER_PARAM = 'roomNumber';

    public function __invoke(Request $request): JsonResponse
    {
        try {
            [$hotelId, $roomNumber] = $this->getParams($request);
            $result = $this->ask(GetReservationByHotelIdAndRoomNumberQuery::from($hotelId, $roomNumber));

            return new JsonResponse($result->response());
        } catch (\Throwable $e) {
            return new JsonResponse($e->getMessage(), 500);
        }
    }

    private function getParams(Request $request): array
    {
        $hotelId = $request->attributes->get(self::HOTEL_ID_PARAM);
        $roomNumber = $request->attributes->get(self::ROOM_NUMBER_PARAM);

        if (null === $hotelId || null === $roomNumber) {
            throw new \InvalidArgumentException('Missing required params.');
        }

        return [$hotelId, $roomNumber];
    }
}
