<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WafSetting extends Model
{
    protected $table = 'waf_settings';

    protected $fillable = [
        'waf_enabled',
        'block_mode',
        'bot_protection',
        'max_requests_per_minute',
    ];

    protected $casts = [
        'waf_enabled' => 'boolean',
        'block_mode' => 'boolean',
        'bot_protection' => 'boolean',
        'max_requests_per_minute' => 'integer',
    ];
}
