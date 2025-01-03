<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectStatus extends Model
{
    protected $fillable = [
        'order_id',
        'order_number',
        'status',
        'description',
        'progress',
        'status_changed_at'
    ];

    protected $casts = [
        'status_changed_at' => 'datetime'
    ];

    const STATUS_DETAILS = [
        'pending' => [
            'label' => 'En attente',
            'progress' => 0,
            'class' => 'bg-gray-100 text-gray-800'
        ],
        'development' => [
            'label' => 'En développement',
            'progress' => 25,
            'class' => 'bg-blue-100 text-blue-800'
        ],
        'production' => [  // Ajout du statut production
            'label' => 'En production',
            'progress' => 50,
            'class' => 'bg-purple-100 text-purple-800'
        ],
        'completed' => [
            'label' => 'Terminé',
            'progress' => 100,
            'class' => 'bg-green-100 text-green-800'
        ]
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function updateStatus($newStatus, $description = null)
    {
        $this->update([
            'status' => $newStatus,
            'description' => $description ?? self::STATUS_DETAILS[$newStatus]['description'] ?? null,
            'progress' => self::STATUS_DETAILS[$newStatus]['progress'],
            'status_changed_at' => now()
        ]);

        return $this;
    }

    protected static function booted()
    {
        static::saving(function ($projectStatus) {
            if ($projectStatus->isDirty('status')) {
                $projectStatus->status_changed_at = now();
            }
        });
    }
}
