<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class QrCode extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'url',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function ($qrCode) {
            if (empty($qrCode->slug)) {
                $qrCode->slug = Str::slug($qrCode->name);
            }
            if (empty($qrCode->url)) {
                $qrCode->url = route('testimonios-form') . '?ref=' . $qrCode->slug;
            }
        });

        static::updating(function ($qrCode) {
            if ($qrCode->isDirty('name') && !$qrCode->isDirty('slug')) {
                $qrCode->slug = Str::slug($qrCode->name);
                $qrCode->url = route('testimonios-form') . '?ref=' . $qrCode->slug;
            }
        });
    }

    public static function getActiveQrs(): \Illuminate\Database\Eloquent\Collection
    {
        return static::where('is_active', true)->orderByDesc('id')->get();
    }
}