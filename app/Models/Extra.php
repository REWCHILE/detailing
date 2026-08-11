<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Extra extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'slug',
        'name',
        'description',
        'price',
        'duration_minutes',
        'is_active',
        'display_order',
    ];

    protected $casts = [
        'price' => 'integer',
        'duration_minutes' => 'integer',
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_extras')
                    ->withPivot(['is_default', 'is_required']);
    }

    public function bookingExtras()
    {
        return $this->hasMany(BookingExtra::class);
    }
}
