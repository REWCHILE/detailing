<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerVehicle extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'customer_id',
        'vehicle_type_id',
        'license_plate',
        'license_plate_normalized',
        'make',
        'model',
        'year',
        'color',
        'notes',
    ];

    protected $casts = [
        'year' => 'integer',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
