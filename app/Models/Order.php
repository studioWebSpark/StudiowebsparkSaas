<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'status',
        'stripe_session_id',
        'paid_at',
        'client_type',
        'first_name',
        'last_name',
        'email',
        'phone',
        'activity',
        'company_name',
        'siren',
        'project_type',
        'project_description',
        'selected_features',
        'selected_forfait',
        'forfait_price',
        'selected_options',
        'maintenance_plan',
        'template_name',
        'template_details'
    ];

    protected $casts = [
        'selected_features' => 'array',
        'selected_options' => 'array',
        'template_details' => 'array',
        'paid_at' => 'datetime',
        'total_amount' => 'float'
    ];

    /**
     * Relation avec l'utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the project associated with the order.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function projectStatus()
    {
        return $this->hasOne(ProjectStatus::class);
    }
}
