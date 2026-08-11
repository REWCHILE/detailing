<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'public_id',
        'customer_id',
        'customer_vehicle_id',
        'service_id',
        'bay_id',
        'created_by_id',
        'start_at',
        'end_at',
        'expires_at',
        'status',
        'payment_status',
        'channel',
        'notes',
        'admin_notes',
        'cancellation_reason',
        
        // Snapshots
        'service_name_snapshot',
        'service_base_price_snapshot',
        'vehicle_type_name_snapshot',
        'vehicle_multiplier_snapshot',
        'duration_minutes',
        
        // Amounts
        'subtotal_amount',
        'extras_amount',
        'total_amount',
        'currency',
        
        'confirmed_at',
        'cancelled_at',
        'completed_at',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'expires_at' => 'datetime',
        'confirmed_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'completed_at' => 'datetime',
        'service_base_price_snapshot' => 'integer',
        'vehicle_multiplier_snapshot' => 'decimal:2',
        'duration_minutes' => 'integer',
        'subtotal_amount' => 'integer',
        'extras_amount' => 'integer',
        'total_amount' => 'integer',
        'status' => \App\Enums\BookingStatus::class,
        'payment_status' => \App\Enums\PaymentStatus::class,
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function customerVehicle()
    {
        return $this->belongsTo(CustomerVehicle::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function bay()
    {
        return $this->belongsTo(WorkBay::class, 'bay_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function extras()
    {
        return $this->hasMany(BookingExtra::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
