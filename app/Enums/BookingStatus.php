<?php

namespace App\Enums;

enum BookingStatus: string
{
    case PENDING = 'PENDING';
    case WAITING = 'WAITING';
    case EXPIRED = 'EXPIRED';
    case ACCEPTED = 'ACCEPTED';
    case IN_PROGRESS = 'IN_PROGRESS';
    case CANCELLED = 'CANCELLED';
    case COMPLETED = 'COMPLETED';
}
