<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, \Illuminate\Database\Eloquent\Concerns\HasUlids;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'image',
        // 'role' and 'status' intentionally excluded from $fillable
        // to prevent mass assignment privilege escalation.
        // Set these fields explicitly: $user->role = UserRole::ADMIN;
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => \App\Enums\UserRole::class,
            'status' => \App\Enums\UserStatus::class,
        ];
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function createdBookings()
    {
        return $this->hasMany(Booking::class, 'created_by_id');
    }

    public function scheduleBlocks()
    {
        return $this->hasMany(ScheduleBlock::class, 'created_by_id');
    }

    public function isAdmin(): bool
    {
        return $this->role === \App\Enums\UserRole::ADMIN;
    }

    public function isStaff(): bool
    {
        return $this->role === \App\Enums\UserRole::STAFF;
    }

    public function isCustomer(): bool
    {
        return $this->role === \App\Enums\UserRole::CUSTOMER;
    }
}
