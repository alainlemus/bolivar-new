<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteInfo extends Model
{
    protected $guarded = [];

    protected static function booted(): void
    {
        static::saved(function () {
            Cache::forget('site_info');
        });

        static::deleted(function () {
            Cache::forget('site_info');
        });
    }

    public static function getSiteInfo(): self
    {
        return Cache::rememberForever('site_info', function () {
            return SiteInfo::first() ?? new SiteInfo();
        });
    }
}