<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller{

    protected UserService $userService;

    /**
     * @param UserService $userService
     * User Service Injection
     */
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    /**
     * @return JsonResponse
     * Get All the Users
     */
    public function index(): JsonResponse
    {
        return $this->userService->getAllUsers();
    }
}
