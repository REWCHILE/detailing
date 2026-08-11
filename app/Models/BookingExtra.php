<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingExtra extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'booking_id',
        'extra_id',
        'name_snapshot',
        'price_snapshot',
        'duration_minutes_snapshot',
    ];

    protected $casts = [
        'price_snapshot' => 'integer',
        'duration_minutes_snapshot' => 'integer',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function extra()
    {
        return $this->belongsTo(Extra::class);
    }
}
