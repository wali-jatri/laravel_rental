<?php
namespace App\Services;
use App\Models\Bidding;
use App\Models\Booking;

class PartnerService{
    public function createBidding($fields, $bookingRequestId)
    {
        $bookingRequest = Booking::find($bookingRequestId);

        if (!$bookingRequest) {
            return response()->json([
                'status' => 'error',
                'message' => 'Booking request not found.',
            ], 404);
        }

        return Bidding::create([
            'booking_id' => $bookingRequest->id,
            'partner_id' => auth('partner')->id(),
            'driver_id' => $fields['driver_id'] ?? null,
            'vehicle_id' => $fields['vehicle_id'] ?? null,
            'bid_amount' => $fields['bid_amount'],
        ]);
    }
}
