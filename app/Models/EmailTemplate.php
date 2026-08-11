<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $table = 'email_templates';

    protected $fillable = [
        'key',
        'name',
        'subject',
        'title',
        'body_text',
        'badge_text',
        'badge_color',
    ];
}
