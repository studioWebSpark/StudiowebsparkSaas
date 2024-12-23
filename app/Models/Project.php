<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'client_type',
        'first_name',
        'last_name',
        'email',
        'phone',
        'company_name',
        'siret',
        'project_type',
        'budget',
        'deadline',
        'description',
        'selected_features',
        'template_id',
        'template_details',
        'selected_options',
        'maintenance_plan',
        'total_price',
        'monthly_maintenance',
        'status'
    ];

    protected $casts = [
        'selected_features' => 'array',
        'template_details' => 'array',
        'selected_options' => 'array',
    ];
}
