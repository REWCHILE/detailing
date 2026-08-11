<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSeo extends Model
{
    protected $table = 'page_seo';

    protected $fillable = [
        'route_key',
        'page_name',
        'page_path',
        'seo_title',
        'seo_description',
    ];

    /**
     * Get a PageSeo record by its route key.
     */
    public static function getByRoute(string $routeKey): ?self
    {
        return static::where('route_key', $routeKey)->first();
    }
}
