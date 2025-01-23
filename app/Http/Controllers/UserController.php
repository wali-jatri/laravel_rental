<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateStatusRequest;
use App\Services\UserService;

class UserController extends Controller{
    public function __construct(protected UserService $userService) {}

    public function updateStatus(UpdateStatusRequest $request, $bookingId)
    {
        $this->userService->updateStatus($bookingId, $request);
    }
}
