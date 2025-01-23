<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest\CreateRequest;
use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ConfirmBidRequest;

class BookingController extends Controller
{
    public function __construct(protected BookingService $bookingService) {}

    /**
     * @return JsonResponse
     * Booking Requests for Specific User
     */
    public function bookingRequests(): JsonResponse
    {
        $user = auth()->user();
        $bookingRequests = Booking::where('user_id', $user->id)->get();
        return response()->json($bookingRequests);
    }

    /**
     * @param CreateRequest $request
     * @return JsonResponse
     * Create Booking Request
     */
    public function bookingRequestCreate(CreateRequest $request): JsonResponse
    {
        return $this->bookingService->bookingRequestCreate($request);
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
        return $this->bookingService->getBidConfirmation($bookingRequestId, $request['bidding_id']);
    }
}
