<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AbonnementCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $abonnement;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($abonnement)
    {
        $this->abonnement = $abonnement;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Votre abonnement a été créé')
                    ->view('emails.abonnement');
    }
}
