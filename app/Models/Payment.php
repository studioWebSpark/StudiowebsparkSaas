<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'order_id',
        'stripe_session_id',
        'amount',
        'status',
        'project_data',
        'paid_at',
        'currency',
        'payment_method',
        'notes'
    ];

    protected $casts = [
        'project_data' => 'array',
        'paid_at' => 'datetime'
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes pour filtrer facilement
    public function scopePending(Builder $query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted(Builder $query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeCancelled(Builder $query)
    {
        return $query->where('status', 'cancelled');
    }

    // Méthodes utilitaires
    public function markAsCompleted()
    {
        $this->update([
            'status' => 'completed',
            'paid_at' => now()
        ]);
    }

    public function markAsCancelled()
    {
        $this->update([
            'status' => 'cancelled'
        ]);
    }

    // Accesseurs
    public function getFormattedAmountAttribute()
    {
        return number_format($this->amount, 2) . ' €';
    }

    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'pending' => '🟡 En attente',
            'completed' => '🟢 Complété',
            'cancelled' => '🔴 Annulé',
            default => '❓ Inconnu'
        };
    }
}
