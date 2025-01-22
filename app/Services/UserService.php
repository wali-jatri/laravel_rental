<?php
namespace App\Services;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserService
{
    public function getAllUsers(): JsonResponse
    {
        User::all();
        return response()->json(User::all());
    }
}
