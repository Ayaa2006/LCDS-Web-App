<?php

namespace App\Mail;

use App\Models\Evenement;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewEventPublished extends Mailable
{
    use Queueable, SerializesModels;

    public $event;

    public function __construct(Evenement $event)
    {
        $this->event = $event;
    }

    public function build()
    {
        return $this->subject('Nouvel événement publié: ' . $this->event->nomEvent)
                   ->view('emails.new_event_published');
    }
}