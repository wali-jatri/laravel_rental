<?php
namespace App\Services;
use App\Models\Bidding as BiddingRequest;
use App\Models\Booking;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Jobs\UpdateBookingStatusJob;

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
        $bookingRequest->status = 'PENDING';
        $bookingRequest->pickup_location = $request->input('pickup_location');
        $bookingRequest->dropoff_location = $request->input('dropoff_location');
        $bookingRequest->save();

        UpdateBookingStatusJob::dispatch($bookingRequest->id)->delay(now()->addMinutes(1));

        return response()->json($bookingRequest);
    }

    /**
     * @param $bookingRequestId
     * @return JsonResponse
     * Available Biddings for Booking Confirmation
     */
    public function getAvailableBids($bookingRequestId): JsonResponse
    {
        $bookingRequest = Booking::with('bidding.partner', 'bidding.driver', 'bidding.vehicle')->find($bookingRequestId);
        if (!$bookingRequest) return response()->json(['error' => 'Booking request not found'], 404);
        return response()->json(['bids' => $bookingRequest->bidding], 200);
    }

    /**
     * @param $bookingRequestId
     * @param $bidding_id
     * @return JsonResponse
     * Confirm Bidding
     */
    public function getBidConfirmation($bookingRequestId, $bidding_id): JsonResponse
    {
        $bookingRequest = Booking::find($bookingRequestId);
        $bidding = BiddingRequest::with('partner', 'driver', 'vehicle')->find($bidding_id);

        if (!$bookingRequest || !$bidding) return response()->json(['error' => 'Invalid booking request or bid'], 404);
        if ($bidding->booking_id !== $bookingRequest->id) return response()->json(['error' => 'Bidding does not belong to this booking request'], 400);

        $bookingRequest->update([
            'bidding_id' => $bidding->id,
            'driver_id' => $bidding->driver_id,
            'vehicle_id' => $bidding->vehicle_id,
            'partner_id' => $bidding->partner_id,
            'status' => 'ACCEPTED'
        ]);

        $bookingConfirmation = $bookingRequest->fresh();

        return response()->json([
            'message' => 'Bidding confirmed successfully',
            'booking_confirmation' => $bookingConfirmation,
        ], 201);
    }
}
