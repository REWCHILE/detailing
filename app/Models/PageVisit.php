<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class PageVisit extends Model
{
    use HasUlids;

    protected $fillable = [
        'page_path',
        'page_title',
        'ip_hash',
        'user_agent',
        'referer',
        'country',
        'region',
        'city',
        'latitude',
        'longitude',
        'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];
}
