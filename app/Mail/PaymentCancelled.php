<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentCancelled extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $cancelId;
    public $projectData;

    public function __construct($user, $cancelId, $projectData)
    {
        $this->user = $user;
        $this->cancelId = $cancelId;
        $this->projectData = $projectData;
    }

    public function build()
    {
        return $this->markdown('emails.payment.cancelled')
            ->subject('Annulation de votre paiement')
            ->with([
                'user' => $this->user,
                'cancelId' => $this->cancelId,
                'projectData' => $this->projectData
            ]);
    }
}
