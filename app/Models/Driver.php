<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Driver extends Model
{
    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }

    public function bids(): BelongsTo
    {
        return $this->belongsTo(Bid::class);
    }
}
