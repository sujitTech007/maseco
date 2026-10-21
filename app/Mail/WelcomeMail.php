<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $account, public string $accountType) {}

    public function build(): self
    {
        return $this->subject('Welcome to Maseco')->view('emails.welcome');
    }
}
