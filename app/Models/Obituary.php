<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Obituary extends Model
{
    protected $fillable = [
        'deceased_name',
        'slug',
        'date_of_death',
        'date_of_birth',
        'age',
        'relationship',
        'responsible_name',
        'responsible_phone',
        'responsible_email',
        'obituary_text',
        'chapel',
        'velatorio_start',
        'velatorio_end',
        'departure_time',
        'destination',
        'cemetery',
        'burial_date',
        'image',
        'is_active',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'date_of_death' => 'date',
        'date_of_birth' => 'date',
        'velatorio_start' => 'datetime',
        'velatorio_end' => 'datetime',
        'burial_date' => 'datetime',
        'is_active' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function ($obituary) {
            if (empty($obituary->slug)) {
                $obituary->slug = Str::slug($obituary->deceased_name);
            }
        });

        static::updating(function ($obituary) {
            if ($obituary->isDirty('deceased_name') && !$obituary->isDirty('slug')) {
                $obituary->slug = Str::slug($obituary->deceased_name);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeActive($query)
    {
        return $query->where(function ($q) {
            $now = now();
            $q->where('is_active', true)
              ->whereNotNull('start_date')
              ->whereNotNull('end_date')
              ->where('start_date', '<=', $now)
              ->where('end_date', '>=', $now);
        });
    }
}