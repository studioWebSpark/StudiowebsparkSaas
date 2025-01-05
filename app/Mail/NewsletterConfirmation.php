<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $newsletter;

    public function __construct($newsletter)
    {
        $this->newsletter = $newsletter;
    }

    public function build()
    {
        return $this->markdown('emails.newsletter.confirmation')
            ->subject('Confirmation de votre inscription à la newsletter - ' . config('app.name'));
    }
}
