<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'slug',
        'name',
        'category',
        'short_description',
        'long_description',
        'base_price',
        'duration_minutes',
        'is_active',
        'is_featured',
        'display_order',
    ];

    protected $casts = [
        'base_price' => 'integer',
        'duration_minutes' => 'integer',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'display_order' => 'integer',
    ];

    public function extras()
    {
        return $this->belongsToMany(Extra::class, 'service_extras')
                    ->withPivot(['is_default', 'is_required', 'is_courtesy', 'is_included'])
                    ->withCasts(['is_default' => 'boolean', 'is_required' => 'boolean', 'is_courtesy' => 'boolean', 'is_included' => 'boolean']);
    }

    public function vehicleTypes()
    {
        return $this->belongsToMany(VehicleType::class, 'service_prices')
                    ->withPivot('price')
                    ->withTimestamps();
    }

    public function getPriceForVehicleType($vehicleTypeId)
    {
        $vt = $this->vehicleTypes->firstWhere('id', $vehicleTypeId);
        if ($vt && $vt->pivot) {
            return (int) $vt->pivot->price;
        }
        return $this->base_price;
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
