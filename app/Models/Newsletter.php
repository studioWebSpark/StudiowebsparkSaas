<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $fillable = [
        'email',
        'token',
        'is_active',
        'confirmed_at'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'confirmed_at' => 'datetime'
    ];
}
