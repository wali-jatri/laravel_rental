<?php

namespace App\Http\Controllers;

use App\Services\BiddingService;
use App\Http\Requests\CreateBiddingRequest;
use Illuminate\Http\JsonResponse;

class BiddingController extends Controller
{
    public function __construct(protected BiddingService $partnerService) {}
    public function createBiddingRequest(CreateBiddingRequest $request, $bookingRequestId): JsonResponse
    {
        $fields = $request->validated();
        return $this->partnerService->createBidding($fields, $bookingRequestId);
    }
}
