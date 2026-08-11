<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class WafWhitelistedIp extends Model
{
    use HasUlids;

    protected $table = 'waf_whitelisted_ips';

    protected $fillable = [
        'ip',
        'reason',
    ];
}
