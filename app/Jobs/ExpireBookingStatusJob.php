<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Booking;

class ExpireBookingStatusJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected $bookingId) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $booking = Booking::find($this->bookingId);

        if ($booking && $booking->status === 'WAITING') {
            $booking->status = 'EXPIRED';
            $booking->save();
        }
    }
}
