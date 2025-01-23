<?php
namespace App\Services;
use App\Enums\BookingStatus;
use App\Models\Booking;
use Illuminate\Http\JsonResponse;

class UserService
{
    public function updateStatus($bookingId, $request): JsonResponse
    {
        $booking = Booking::find($bookingId);
        if($booking->status == BookingStatus::WAITING->value){
            $booking->update(['status' => $request->status]);
            return response()->json(['message' => 'Booking status updated successfully.'], 200);
        } else {
            return response()->json(['message' => 'Booking status cannot be updated.'], 400);
        }
    }
}
