<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $order_number;
    public $projectData;
    public $amount;

    public function __construct($user, $order_number, $projectData, $amount)
    {
        $this->user = $user;
        $this->order_number = $order_number;
        $this->projectData = $projectData;
        $this->amount = $amount;
    }

    public function build()
    {
        return $this->subject('Confirmation de votre paiement')
            ->markdown('emails.payments.success');
    }
}
