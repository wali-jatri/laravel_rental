<?php

namespace App\Http\Controllers;

use App\Models\BookingRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookingRequestController extends Controller
{
    public function index(): View
    {
        $bookingRequests = BookingRequest::all();
        dd($bookingRequests);
        return view('booking-request.index', compact('bookingRequests'));
    }

    public function create(): View
    {
        return view('booking-request.create');
    }
}
