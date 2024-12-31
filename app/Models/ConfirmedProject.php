<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfirmedProject extends Model
{
    protected $fillable = [
        'user_id',
        'email',
        'form_data',
        'order_number',
        'status'
    ];

    protected $casts = [
        'form_data' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
