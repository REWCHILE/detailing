<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class WafBlockedIp extends Model
{
    use HasUlids;

    protected $table = 'waf_blocked_ips';

    protected $fillable = [
        'ip',
        'reason',
        'blocked_at',
        'expires_at',
    ];

    protected $casts = [
        'blocked_at' => 'datetime',
        'expires_at' => 'datetime',
    ];
}
