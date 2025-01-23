<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Http\Requests\Partner\UpdateStatusRequest;

class PartnerController extends Controller
{
    public function updateStatus(UpdateStatusRequest $request, $bookingId)
    {
        $booking = Booking::find($bookingId);
        if($booking->status == 'ACCEPTED'){
            $booking->update(['status' => $request->status]);
            return response()->json(['message' => 'Booking status updated successfully.'], 200);
        } else {
            return response()->json(['message' => 'Booking status cannot be updated.'], 400);
        }

    }
}
