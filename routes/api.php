<?php

use App\Http\Controllers\BiddingController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;

// For users
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('booking-requests')->middleware('auth:sanctum')->group(function () {
    Route::get('/index', [BookingController::class, 'bookingRequests']);
    Route::post('/create', [BookingController::class, 'bookingRequestCreate']);
});

Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::post('/register', [AuthController::class, 'register'])->name('user.register');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/user/status/{bookingId}', [UserController::class, 'updateStatus'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/bidding-requests/{bookingId}', [BiddingController::class, 'createBiddingRequest']);
    Route::get('/booking-requests/{bookingId}/bids', [BookingController::class, 'getAvailableBids']);
    Route::post('/booking-requests/{bookingId}/confirm-bid', [BookingController::class, 'confirmBid']);
    Route::post('/partner/status/{bookingId}', [PartnerController::class, 'updateStatus']);
});

// Auth routes for partners
Route::post('/partner-login', [AuthController::class, 'partnerLogin'])->name('partner.login');
Route::post('/partner-register', [AuthController::class, 'partnerRegister'])->name('partner.register');
Route::post('/partner-logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');






