<?php
namespace App\Services;
use App\Enums\BookingStatus;
use App\Models\Booking;
use Illuminate\Http\JsonResponse;

class PartnerService{
    public function updateStatus($request, $bookingId): JsonResponse
    {
        $booking = Booking::find($bookingId);
        if($booking->status == BookingStatus::ACCEPTED->value){
            $booking->update(['status' => $request->status]);
            return response()->json(['message' => 'Booking status updated successfully.'], 200);
        } else {
            return response()->json(['message' => 'Booking status cannot be updated.'], 400);
        }
    }
}
