<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactInquiryNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $contact) {}

    public function build(): self
    {
        return $this->replyTo($this->contact->email, $this->contact->name)
            ->subject('New contact form message from ' . $this->contact->name)
            ->view('emails.contact-notification');
    }
}
