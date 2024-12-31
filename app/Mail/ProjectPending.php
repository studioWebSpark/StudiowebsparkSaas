<?php

namespace App\Mail\Project;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProjectPending extends Mailable
{
    use SerializesModels;

    public $project;
    public $user;

    public function __construct($project, $user)
    {
        $this->project = $project;
        $this->user = $user;
    }

    public function build()
    {
        return $this->markdown('emails.project.pending')
            ->subject('Votre projet est en attente de paiement');
    }
}
