<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingProject extends Model
{
    protected $fillable = [
        'user_id',
        'email',
        'form_data_step_1',
        'form_data_step_2',
        'form_data_step_3',
        'form_data_step_4',
        'last_completed_step',
        'status'
    ];

    protected $casts = [
        'form_data_step_1' => 'array',
        'form_data_step_2' => 'array',
        'form_data_step_3' => 'array',
        'form_data_step_4' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
