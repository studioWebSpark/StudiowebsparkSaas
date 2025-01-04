<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientSupport extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $subject;
    public $clientMessage;

    public function __construct($user, $subject, $clientMessage)
    {
        $this->user = $user;
        $this->subject = $subject;
        $this->clientMessage = $clientMessage;
    }

    public function build()
    {
        return $this->subject('Nouveau message de support client')
            ->markdown('emails.support.message');
    }
}
