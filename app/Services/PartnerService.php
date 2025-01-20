<?php
namespace App\Services;
use App\Models\Bid;
use App\Models\BookingRequest;

class PartnerService{
    public function createBidding($fields, $bookingRequestId)
    {
        $bookingRequest = BookingRequest::find($bookingRequestId);

        if (!$bookingRequest) {
            return response()->json([
                'status' => 'error',
                'message' => 'Booking request not found.',
            ], 404);
        }

        return Bid::create([
            'booking_request_id' => $bookingRequest->id,
            'partner_id' => auth('partner')->id(),
            'driver_id' => $fields['driver_id'] ?? null,
            'vehicle_id' => $fields['vehicle_id'] ?? null,
            'bid_amount' => $fields['bid_amount'],
        ]);
    }
}
