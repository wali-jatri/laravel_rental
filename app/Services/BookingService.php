<?php
namespace App\Services;
use App\Models\Bid as BiddingRequest;
use App\Models\BookingConfirmation;
use App\Models\BookingRequest;
use Illuminate\Http\JsonResponse;

class BookingService
{
    /**
     * @param $bookingRequestId
     * @return JsonResponse
     * Available Bids for Booking Confirmation
     */
    public function getAvailableBids($bookingRequestId): JsonResponse
    {
        $bookingRequest = BookingRequest::with('bids.partner', 'bids.driver', 'bids.vehicle')->find($bookingRequestId);

        if (!$bookingRequest) {
            return response()->json(['error' => 'Booking request not found'], 404);
        }

        return response()->json(['bids' => $bookingRequest->bids], 200);
    }

    /**
     * @param $bookingRequestId
     * @param $fields
     * @return JsonResponse
     * Confirm Bid
     */
    public function getBidConfirmation($bookingRequestId, $fields): JsonResponse
    {
        $bookingRequest = BookingRequest::find($bookingRequestId);
        $bid = BiddingRequest::with('partner', 'driver', 'vehicle')->find($fields['bid_id']);

        if (!$bookingRequest || !$bid) {
            return response()->json(['error' => 'Invalid booking request or bid'], 404);
        }

        if ($bid->booking_request_id !== $bookingRequest->id) {
            return response()->json(['error' => 'Bid does not belong to this booking request'], 400);
        }

        $bookingConfirmation = BookingConfirmation::create([
            'booking_request_id' => $bookingRequest->id,
            'bid_id' => $bid->id,
            'user_id' => $bookingRequest->user_id,
            'driver_id' => $bid->driver_id,
            'vehicle_id' => $bid->vehicle_id,
            'partner_id' => $bid->partner_id,
            'pickup_location' => $bookingRequest->pickup_location,
            'dropoff_location' => $bookingRequest->dropoff_location,
        ]);

        return response()->json([
            'message' => 'Bid confirmed successfully',
            'booking_confirmation' => $bookingConfirmation,
        ], 201);
    }
}
