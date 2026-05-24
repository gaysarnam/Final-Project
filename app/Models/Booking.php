<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'service_type',
        'service_name',
        'number_of_guests',
        'booking_date',
        'booking_time',
        'check_out_date',
        'special_request',
        'order_items',
        'status',
        'cancellation_reason'
    ];

    protected $casts = [
        'booking_date' => 'date',
        'check_out_date' => 'date',
        'order_items' => 'array', // This will auto-convert JSON to array
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}