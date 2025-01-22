<?php
namespace App\Services;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthService{
    public function userRegister($fields, $request): array
    {
        $user = User::create($fields);
        $token = $user->createToken($request->name);

        $plainToken = $token->plainTextToken;

        return [
            'user' => $user,
            'token' => $plainToken,
        ];
    }

    public function userLogin($fields): array
    {
        $user = User::where('email', $fields['email'])->first();
        $token = $user->createToken($user->name);

        return [
            'user' => $user,
            'token' => $token->plainTextToken,
        ];
    }

    public function Logout($request)
    {
        $request->user()->tokens()->delete();
    }

    public function PartnerLogin($request): JsonResponse
    {
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

    public function PartnerRegister($request): JsonResponse
    {
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
