<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $orderData;
    public $user;

    public function __construct($user, $orderData)
    {
        $this->user = $user;
        $this->orderData = $orderData;
    }

    public function build()
    {
        return $this->markdown('emails.orders.confirmation')
            ->subject('Confirmation de votre commande - ' . config('app.name'))
            ->with([
                'orderData' => $this->orderData,
                'user' => $this->user
            ]);
    }
}
