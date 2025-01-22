<?php

namespace App\Http\Controllers;

use App\Services\BookingService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ConfirmBidRequest;

class BookingController extends Controller
{
    public function __construct(protected BookingService $bookingService) {}

    /**
     * @param $bookingRequestId
     * @return JsonResponse
     * Get All the Available Bids from Partner Side
     */
    public function getAvailableBids($bookingRequestId): JsonResponse
    {
        return $this->bookingService->getAvailableBids($bookingRequestId);
    }

    /**
     * @param ConfirmBidRequest $request
     * @param $bookingRequestId
     * @return JsonResponse
     *
     * Confirm Bidding from the partner side
     */
    public function confirmBid(ConfirmBidRequest $request, $bookingRequestId): JsonResponse
    {
        return $this->bookingService->getBidConfirmation($bookingRequestId, $request['bid_id']);
    }
}
