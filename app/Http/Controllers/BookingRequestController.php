<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest\CreateRequest;
use App\Models\BookingRequest;
use App\Services\BookingRequestService;
use Illuminate\Http\JsonResponse;

class BookingRequestController extends Controller
{
    public function __construct(protected BookingRequestService $bookingRequestService) {}

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
