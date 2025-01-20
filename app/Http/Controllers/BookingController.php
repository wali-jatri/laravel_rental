<?php

namespace App\Http\Controllers;

use App\Services\BookingService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ConfirmBidRequest;

class BookingController extends Controller
{
    protected BookingService $bookingService;
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function getAvailableBids($bookingRequestId): JsonResponse
    {
        return $this->bookingService->getAvailableBids($bookingRequestId);
    }

    public function confirmBid(ConfirmBidRequest $request, $bookingRequestId): JsonResponse
    {
        $fields = $request->validated();
        return $this->bookingService->getBidConfirmation($bookingRequestId, $fields);
    }
}
