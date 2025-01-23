<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Http\Requests\Partner\UpdateStatusRequest;

class PartnerController extends Controller
{
    public function updateStatus(UpdateStatusRequest $request, $bookingId)
    {
        Booking::find($bookingId)->update(['status' => $request->status]);
        return response()->json(['message' => 'Booking status updated successfully.'], 200);
    }
}
