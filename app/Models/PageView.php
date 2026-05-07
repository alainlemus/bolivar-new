<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $fillable = [
        'type',
        'slug',
        'label',
        'ip_address',
        'user_agent',
        'country',
        'country_code',
        'city',
    ];

    public static function record(string $type, ?string $slug = null, ?string $label = null): void
    {
        static::create([
            'type' => $type,
            'slug' => $slug,
            'label' => $label,
            'ip_address' => request()->ip() ?? '',
            'user_agent' => substr(request()->userAgent() ?? '', 0, 255),
        ]);
    }
}