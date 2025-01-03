<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Notifications\ProjectStatusUpdated;

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

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function updateStatus($newStatus)
    {
        $progressMap = [
            'pending' => 0,
            'development' => 25,
            'finalizing' => 50,
            'production' => 75,
            'completed' => 100
        ];

        $this->update([
            'status' => $newStatus,
            'progress' => $progressMap[$newStatus],
            'started_at' => $newStatus === 'development' ? now() : $this->started_at,
            'completed_at' => $newStatus === 'completed' ? now() : $this->completed_at,
            'current_step_description' => $this->getStepDescription($newStatus)
        ]);

        $this->order->notify(new ProjectStatusUpdated($this, $newStatus));
    }

    private function getStepDescription($status)
    {
        return match ($status) {
            'pending' => 'Projet en attente de démarrage',
            'development' => 'Développement en cours',
            'production' => 'Mise en production',
            'completed' => 'Projet terminé',
            default => 'État inconnu'
        };
    }
}
