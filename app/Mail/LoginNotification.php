<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class LoginNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $ipAddress;
    public $device;

    public function __construct(User $user, $ipAddress, $device)
    {
        $this->user = $user;
        $this->ipAddress = $ipAddress;
        $this->device = $device;
    }

    public function build()
    {
        return $this->markdown('emails.login-notification')
            ->subject('Nouvelle connexion à votre compte');
    }
}
