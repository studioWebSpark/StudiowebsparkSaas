<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $orderId;
    public $projectData;

    public function __construct($user, $orderId, $projectData)
    {
        $this->user = $user;
        $this->orderId = $orderId;
        $this->projectData = $projectData;
    }

    public function build()
    {
        return $this->markdown('emails.payments.success')
            ->subject('Confirmation de votre paiement - ' . config('app.name'));
    }
}
