<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'status',
        'order_id',
        'progress',
        'milestones',
        'current_step_description',
        'started_at',
        'completed_at'
    ];

    protected $casts = [
        'selected_features' => 'array',
        'template_details' => 'array',
        'selected_options' => 'array',
        'milestones' => 'array',
        'started_at' => 'datetime',
        'completed_at' => 'datetime'
    ];

    /**
     * Get the order for the project.
     */
    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }
}
