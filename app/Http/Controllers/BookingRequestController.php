<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest\CreateRequest;
use App\Models\BookingRequest;
use App\Services\BookingRequestService;
use Illuminate\Http\JsonResponse;

class BookingRequestController extends Controller
{
    protected BookingRequestService $bookingRequestService;

    public function __construct(BookingRequestService $bookingRequestService){
        $this->bookingRequestService = $bookingRequestService;
    }

    public function index(): JsonResponse
    {
        $bookingRequests = BookingRequest::all();
        return response()->json($bookingRequests);
    }

    public function store(CreateRequest $request): JsonResponse
    {
        $request->validated();
        return $this->bookingRequestService->bookingRequestCreate($request);
    }
}
