<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MapPlace extends Model
{
    protected $fillable = [
        'type', 'name', 'address', 'alcaldia', 'lat', 'lng', 'phone', 'sector', 'source', 'is_active',
    ];

    protected $casts = [
        'lat' => 'float',
        'lng' => 'float',
        'is_active' => 'boolean',
    ];

    public const TYPES = [
        'panteon' => 'Panteón',
        'crematorio' => 'Crematorio',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
