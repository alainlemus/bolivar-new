<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'icon',
        'features',
        'order',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function getFeaturesArrayAttribute()
    {
        return $this->features ? json_decode($this->features, true) : [];
    }
}