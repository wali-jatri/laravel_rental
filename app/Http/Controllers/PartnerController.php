<?php

namespace App\Http\Controllers;

use App\Services\PartnerService;
use App\Http\Requests\CreateBiddingRequest;
use Illuminate\Http\JsonResponse;

class PartnerController extends Controller
{
    public function __construct(protected PartnerService $partnerService) {}
    public function createBiddingRequest(CreateBiddingRequest $request, $bookingRequestId): JsonResponse
    {
        $fields = $request->validated();
        $biddingRequest = $this->partnerService->createBidding($fields, $bookingRequestId);

        return response()->json([
            'status' => 'success',
            'bidding_request' => $biddingRequest,
        ], 201);
    }
}
