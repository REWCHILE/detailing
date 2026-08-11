<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'booking_id',
        'provider',
        'provider_payment_id',
        'provider_preference_id',
        'external_reference',
        'amount',
        'currency',
        'status',
        'raw_status',
        'checkout_url',
        'failure_code',
        'failure_message',
        'expires_at',
        'paid_at',
        'webhook_payload',
    ];

    protected $casts = [
        'amount' => 'integer',
        'expires_at' => 'datetime',
        'paid_at' => 'datetime',
        'webhook_payload' => 'array',
        'status' => \App\Enums\PaymentStatus::class,
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
