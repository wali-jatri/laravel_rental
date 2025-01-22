<?php

namespace App\Http\Controllers;

use App\Services\BookingService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ConfirmBidRequest;

class BookingController extends Controller
{
    /**
     * @var BookingService
     */
    protected BookingService $bookingService;

    /**
     * @param BookingService $bookingService
     * Booking Service Injection
     */
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

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
        $fields = $request->validated();
        return $this->bookingService->getBidConfirmation($bookingRequestId, $fields);
    }
}
