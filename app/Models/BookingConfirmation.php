<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingConfirmation extends Model
{
    protected $table = 'booking_confirmations';

    protected $guarded = [];

    public function bookingRequest()
    {
        return $this->belongsTo(BookingRequest::class, 'booking_request_id');
    }

    public function bids()
    {
        return $this->belongsTo(Bid::class, 'bid_id');
    }
}
