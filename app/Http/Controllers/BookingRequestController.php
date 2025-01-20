<?php

namespace App\Http\Controllers;

use App\Models\BookingRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingRequestController extends Controller
{
    public function index(): JsonResponse
    {
        $bookingRequests = BookingRequest::all();
        return response()->json($bookingRequests);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'pickup_location' => 'required|string|max:255',
            'dropoff_location' => 'required|string|max:255',
        ]);

        $bookingRequest = new BookingRequest();
        $bookingRequest->user_id = Auth::id();
        $bookingRequest->pickup_location = $request->input('pickup_location');
        $bookingRequest->dropoff_location = $request->input('dropoff_location');
        $bookingRequest->save();

        return response()->json($bookingRequest);
    }
}
