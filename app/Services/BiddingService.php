<?php
namespace App\Services;
use App\Enums\BookingStatus;
use App\Models\Bidding;
use App\Models\Booking;

class BiddingService{
    public function createBidding($fields, $bookingId)
    {
        $booking = Booking::find($bookingId);

        if (!$booking) {
            return response()->json([
                'status' => 'error',
                'message' => 'Booking request not found.',
            ], 404);
        }

        if ($booking->status == BookingStatus::PENDING->value) {
            $biddingRequest = Bidding::create([
                'booking_id' => $booking->id,
                'partner_id' => auth('partner')->id(),
                'driver_id' => $fields['driver_id'] ?? null,
                'vehicle_id' => $fields['vehicle_id'] ?? null,
                'bid_amount' => $fields['bid_amount'],
            ]);
            return response()->json([
                'status' => 'success',
                'message' => $biddingRequest,
            ]);

        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Booking request can not be confirmed.',
            ]);
        }
    }
}
