<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MassMail extends Mailable
{
    use Queueable, SerializesModels;

    public $massmail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($massmail)
    {
        $this->massmail = $massmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->massmail['subject'];
        return $this->markdown('email.mass_email')->subject($subject);
    }
}
