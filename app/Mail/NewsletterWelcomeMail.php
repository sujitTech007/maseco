<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $newsletter) {}

    public function build(): self
    {
        return $this->subject('Thanks for subscribing to Maseco')->view('emails.newsletter-welcome');
    }
}
