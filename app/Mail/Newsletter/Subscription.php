<?php

namespace App\Mail\Newsletter;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Subscription extends Mailable
{
    use SerializesModels;

    public $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function build()
    {
        return $this->markdown('emails.newsletter.subscription')
            ->subject('Confirmation d\'inscription à la newsletter');
    }
}
