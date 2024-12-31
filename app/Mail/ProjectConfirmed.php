<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ConfirmedProject;

class ProjectConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $project;

    public function __construct(ConfirmedProject $project)
    {
        $this->project = $project;
    }

    public function build()
    {
        return $this->markdown('emails.projects.confirmed')
            ->subject('Confirmation de votre projet - StudioWebspark');
    }
}
