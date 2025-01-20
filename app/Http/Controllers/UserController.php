<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller{
    public function index(): JsonResponse
    {
        User::all();
        return response()->json(User::all());
    }
}
