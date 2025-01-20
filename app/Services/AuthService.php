<?php
namespace App\Services;
use App\Models\User;

class AuthService{
    public function UserRegister($fields, $request)
    {
        $user = User::create($fields);
        $token = $user->createToken($request->name);

        $plainToken = $token->plainTextToken;

        return [
            'user' => $user,
            'token' => $plainToken
        ];
    }

    public function UserLogin($fields){
        $user = User::where('email', $fields['email'])->first();
        $token = $user->createToken($user->name);

        return [
            'user' => $user,
            'token' => $token->plainTextToken,
        ];
    }

    public function Logout($request){
        $request->user()->tokens()->delete();
    }
}
