<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;

class AuthController extends Controller
{
    protected AuthService $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * User Registration
     */
    public function register(AuthRequest $request)
    {
        $fields = $request->validated();
        $result = $this->authService->UserRegister($fields, $request);

        return response()->json($result, 201);
    }

    /**
     * User Login
     */
    public function login(AuthRequest $request)
    {
        $fields = $request->validated();
        $result = $this->authService->UserLogin($fields);

        return response()->json($result, 201);
    }

    /**
     * User & Partner Logout
     */
    public function logout(AuthRequest $request)
    {
        $this->authService->logout($request);
        return ['message' => 'Logged out successfully.'];
    }

    /**
     * Partner login
     */
    public function partnerLogin(Request $request)
    {
        return $this->authService->partnerLogin($request);
    }

    /**
     * Partner registration
     */
    public function partnerRegister(AuthRequest $request)
    {
        return $this->authService->partnerRegister($request);
    }
}
