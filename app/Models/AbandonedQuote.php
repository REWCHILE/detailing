<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class AbandonedQuote extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'session_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'commune',
        'vehicle_type_name',
        'service_name',
        'extras',
        'total_price',
        'last_step_reached',
        'status',
        'last_activity_at',
    ];

    protected $casts = [
        'extras' => 'array',
        'last_activity_at' => 'datetime',
    ];
}
