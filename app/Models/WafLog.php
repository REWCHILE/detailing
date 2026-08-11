<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class WafLog extends Model
{
    use HasUlids;

    protected $table = 'waf_logs';

    public $timestamps = false;

    protected $fillable = [
        'ip',
        'url',
        'method',
        'user_agent',
        'payload',
        'threat_type',
        'threat_score',
        'is_bot',
        'country',
        'city',
        'region',
        'status',
        'created_at',
    ];

    protected $casts = [
        'is_bot' => 'boolean',
        'threat_score' => 'integer',
        'created_at' => 'datetime',
    ];
}
