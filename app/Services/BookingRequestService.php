<?php
namespace App\Services;
use App\Models\BookingRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class BookingRequestService
{
    public function bookingRequestCreate($request): JsonResponse
    {
        $bookingRequest = new BookingRequest();
        $bookingRequest->user_id = Auth::id();
        $bookingRequest->pickup_location = $request->input('pickup_location');
        $bookingRequest->dropoff_location = $request->input('dropoff_location');
        $bookingRequest->save();

        return response()->json($bookingRequest);
    }
}
