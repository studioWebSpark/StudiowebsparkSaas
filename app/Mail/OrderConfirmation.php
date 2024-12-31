<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $user;

    public function __construct($order, $user)
    {
        $this->order = $order;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Confirmation de votre commande - Studio Webspark')
            ->markdown('emails.orders.confirmation')
            ->with([
                'order' => $this->order,
                'user' => $this->user
            ]);
    }
}
