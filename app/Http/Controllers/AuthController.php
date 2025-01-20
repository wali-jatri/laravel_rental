<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $credentials = $request->only('contact_number', 'password');

        $partner = Partner::where('contact_number', $request->contact_number)->first();

        if ($partner && Hash::check($request->password, $partner->password)) {
            $token = $partner->createToken('PartnerToken')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'token' => $token,
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Unauthorized',
        ], 401);
    }

    /**
     * Partner registration
     */
    public function partnerRegister(AuthRequest $request)
    {
        $fields = $request->validated();

        $partner = Partner::create([
            'name' => $request->name,
            'contact_number' => $request->contact_number,
            'password' => Hash::make($request->password),
        ]);

        $token = $partner->createToken('PartnerToken')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'token' => $token,
        ], 201);
    }
}
