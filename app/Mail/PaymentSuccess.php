<?php

namespace App\Mail\Project;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentConfirmation extends Mailable
{
    use SerializesModels;

    public $payment;
    public $project;
    public $user;

    public function __construct($payment, $project, $user)
    {
        $this->payment = $payment;
        $this->project = $project;
        $this->user = $user;
    }

    public function build()
    {
        return $this->markdown('emails.project.payment-confirmation')
            ->subject('Confirmation de paiement - ' . config('app.name'));
    }
}
