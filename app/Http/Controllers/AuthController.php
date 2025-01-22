<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\PartnerLoginRequest;
use App\Http\Requests\Auth\PartnerRegisterRequest;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function __construct(protected AuthService $authService) {}

    /**
     * @param UserRegisterRequest $request
     * User Registration
     */
    public function register(UserRegisterRequest $request): JsonResponse
    {
        $fields = $request->validated();
        $result = $this->authService->userRegister($fields, $request);

        return response()->json($result, 201);
    }

    /**
     * User Login
     */
    public function login(UserLoginRequest $request): JsonResponse
    {
        $fields = $request->validated();
        $result = $this->authService->userLogin($fields);

        return response()->json($result, 201);
    }

    /**
     * User & Partner Logout
     */
    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout($request);
        return response()->json(['message' => 'Logged out successfully.']);
    }

    /**
     * Partner login
     */
    public function partnerLogin(PartnerLoginRequest $request): JsonResponse
    {
        return $this->authService->PartnerLogin($request);
    }

    /**
     * Partner registration
     */
    public function partnerRegister(PartnerRegisterRequest $request): JsonResponse
    {
        return $this->authService->partnerRegister($request);
    }
}
