<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller{
    public function __construct(protected UserService $userService) {}

    /**
     * @return JsonResponse
     * Get All the Users
     */
    public function index(): JsonResponse
    {
        return $this->userService->getAllUsers();
    }
}
