<?php

namespace App\Mail;

use App\Models\Evenement;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventDeleted extends Mailable
{
    use Queueable, SerializesModels;

    public $event;

    public function __construct(Evenement $event)
    {
        $this->event = $event;
    }

    public function build()
    {
        return $this->subject('Événement terminé: ' . $this->event->nomEvent)
                   ->view('emails.event_deleted');
    }
}