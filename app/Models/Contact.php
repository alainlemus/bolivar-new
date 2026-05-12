<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'status',
        'read_at',
        'admin_notes',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];
}
