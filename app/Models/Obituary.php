<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obituary extends Model
{
    protected $fillable = [
        'deceased_name',
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
    ];

    protected $casts = [
        'date_of_death' => 'date',
        'date_of_birth' => 'date',
        'velatorio_start' => 'datetime',
        'velatorio_end' => 'datetime',
        'burial_date' => 'datetime',
        'is_active' => 'boolean',
    ];
}