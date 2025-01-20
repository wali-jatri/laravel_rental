<?php

use App\Http\Controllers\PartnerController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingRequestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;

// For users
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('booking-requests', BookingRequestController::class)->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::post('/register', [AuthController::class, 'register'])->name('user.register');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('users', [UserController::class, 'index'])->middleware('auth:sanctum');


// For partners
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('partners', PartnerController::class)->middleware('auth:sanctum');
    Route::post('/bidding-requests/{bookingRequestId}', [PartnerController::class, 'createBiddingRequest']);
    Route::get('/booking-requests/{id}/bids', [BookingController::class, 'getAvailableBids']);
    Route::post('/booking-requests/{id}/confirm-bid', [BookingController::class, 'confirmBid']);
});

// Auth routes for partners
Route::post('/partner-login', [AuthController::class, 'partnerLogin'])->name('partner.login');
Route::post('/partner-register', [AuthController::class, 'partnerRegister'])->name('partner.register');
Route::post('/partner-logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');




