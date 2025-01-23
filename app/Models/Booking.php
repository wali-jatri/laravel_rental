<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bidding(): HasMany
    {
        return $this->hasMany(Bidding::class);
    }

    public function selectedBidding(): BelongsTo
    {
        return $this->belongsTo(Bidding::class, 'bidding_id');
    }
}
