<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateStatusRequest;
use App\Models\Booking;
use App\Services\UserService;
use App\Enums\BookingStatus;
use Illuminate\Http\JsonResponse;

class UserController extends Controller{
    public function __construct(protected UserService $userService) {}

    public function updateStatus(UpdateStatusRequest $request, $bookingId)
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
