<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentFailed extends Mailable
{
    use SerializesModels;

    public $payment;
    public $error;

    public function __construct($payment, $error)
    {
        $this->payment = $payment;
        $this->error = $error;
    }

    public function build()
    {
        return $this->subject('Échec du paiement - ' . config('app.name'))
            ->markdown('emails.payment.failed');
    }
}
