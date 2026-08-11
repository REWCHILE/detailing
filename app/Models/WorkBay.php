<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkBay extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'name',
        'is_active',
        'display_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'bay_id');
    }
}
