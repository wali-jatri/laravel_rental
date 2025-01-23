<?php
namespace App\Services;
use App\Models\Bidding as BiddingRequest;
use App\Models\Booking;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class BookingService
{
    /**
     * @param $request
     * @return JsonResponse
     * Create Booking Request
     */
    public function bookingRequestCreate($request): JsonResponse
    {
        $bookingRequest = new Booking();
        $bookingRequest->user_id = Auth::id();
        $bookingRequest->pickup_location = $request->input('pickup_location');
        $bookingRequest->dropoff_location = $request->input('dropoff_location');
        $bookingRequest->save();

        return response()->json($bookingRequest);
    }

    /**
     * @param $bookingRequestId
     * @return JsonResponse
     * Available Bids for Booking Confirmation
     */
    public function getAvailableBids($bookingRequestId): JsonResponse
    {
        $bookingRequest = Booking::with('bids.partner', 'bids.driver', 'bids.vehicle')->find($bookingRequestId);
        if (!$bookingRequest) return response()->json(['error' => 'Booking request not found'], 404);
        return response()->json(['bids' => $bookingRequest->bids], 200);
    }

    /**
     * @param $bookingRequestId
     * @param $bid_id
     * @return JsonResponse
     * Confirm Bidding
     */
    public function getBidConfirmation($bookingRequestId, $bid_id): JsonResponse
    {
        $bookingRequest = Booking::find($bookingRequestId);
        $bid = BiddingRequest::with('partner', 'driver', 'vehicle')->find($bid_id);

        if (!$bookingRequest || !$bid) return response()->json(['error' => 'Invalid booking request or bid'], 404);
        if ($bid->booking_request_id !== $bookingRequest->id) return response()->json(['error' => 'Bidding does not belong to this booking request'], 400);

        $bookingConfirmation = Booking::create([
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
            'message' => 'Bidding confirmed successfully',
            'booking_confirmation' => $bookingConfirmation,
        ], 201);
    }
}
