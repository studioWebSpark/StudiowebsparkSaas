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
    public $amount;

    public function __construct($user, $cancelId, $projectData, $amount = null)
    {
        $this->user = $user;
        $this->cancelId = $cancelId;
        $this->projectData = $projectData;
        $this->amount = $amount;
    }

    public function build()
    {
        return $this->markdown('emails.payments.cancelled')
            ->subject('Annulation de votre commande - ' . config('app.name'));
    }
}
