<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\ProjectStatus;
use Illuminate\Support\Facades\Log;

class ProjectStatusChanged extends Notification
{
    use Queueable;

    public function __construct(private ProjectStatus $projectStatus) {}

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        Log::info('Envoi email pour changement de statut', [
            'to' => $notifiable->email,
            'order_number' => $this->projectStatus->order->order_number,
            'status' => $this->projectStatus->status
        ]);

        try {
            return (new MailMessage)
                ->subject('Mise à jour de votre projet #' . $this->projectStatus->order->order_number)
                ->markdown('emails.project.status-changed', [
                    'user' => $notifiable,
                    'projectStatus' => $this->projectStatus,
                    'order' => $this->projectStatus->order,
                    'statusDetails' => ProjectStatus::STATUS_DETAILS[$this->projectStatus->status]
                ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi de l\'email de changement de statut', [
                'error' => $e->getMessage(),
                'order_number' => $this->projectStatus->order->order_number
            ]);
        }
    }
}
