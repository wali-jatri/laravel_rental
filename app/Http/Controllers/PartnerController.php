<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\BookingRequest;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function createBiddingRequest(Request $request, $bookingRequestId)
    {
        $fields = $request->validate([
            'bid_amount' => 'required|numeric|min:1',
            'driver_id' => 'nullable|exists:drivers,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
        ]);

        $bookingRequest = BookingRequest::find($bookingRequestId);

        if (!$bookingRequest) {
            return response()->json([
                'status' => 'error',
                'message' => 'Booking request not found.',
            ], 404);
        }

        $biddingRequest = Bid::create([
            'booking_request_id' => $bookingRequest->id,
            'partner_id' => auth('partner')->id(),
            'driver_id' => $fields['driver_id'] ?? null,
            'vehicle_id' => $fields['vehicle_id'] ?? null,
            'bid_amount' => $fields['bid_amount'],
        ]);

        return response()->json([
            'status' => 'success',
            'bidding_request' => $biddingRequest,
        ], 201);
    }
}
