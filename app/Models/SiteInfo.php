<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteInfo extends Model
{
    protected $guarded = [];

    protected $casts = [
        'gallery_images' => 'array',
    ];

    public static function getSiteInfo(): self
    {
        return SiteInfo::first() ?? new SiteInfo();
    }
}