<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactReply extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $replyMessage;
    public $originalMessage;

    public function __construct($subject, $replyMessage, $originalMessage)
    {
        $this->subject = $subject;
        $this->replyMessage = $replyMessage;
        $this->originalMessage = $originalMessage;
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->view('emails.contact_reply');
    }
}