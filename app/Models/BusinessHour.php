<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessHour extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'weekday',
        'is_closed',
        'open_minute_of_day',
        'close_minute_of_day',
    ];

    protected $casts = [
        'is_closed' => 'boolean',
        'open_minute_of_day' => 'integer',
        'close_minute_of_day' => 'integer',
    ];
}
