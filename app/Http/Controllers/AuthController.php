<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /*
     * User Registration
     */
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::create($fields);

        $token = $user->createToken($request->name);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    /*
     * User Login
     */
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);

        $user = User::where('email', $fields['email'])->first();
        $token = $user->createToken($user->name);

        return [
            'user' => $user,
            'token' => $token->plainTextToken,
        ];
    }

    /*
     * User Logout
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
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
    public function partnerRegister(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:255|unique:partners',
            'password' => 'required|string|min:6|confirmed',
        ]);

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
