<?php

namespace App\Http\Controllers;
use App\Http\Requests\Partner\UpdateStatusRequest;
use App\Services\PartnerService;

class PartnerController extends Controller
{
    public function __construct(protected PartnerService $partnerService) {}

    public function updateStatus(UpdateStatusRequest $request, $bookingId)
    {
        return $this->partnerService->updateStatus($bookingId, $request);
    }
}
