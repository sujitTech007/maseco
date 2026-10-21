<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionPurchasedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $purchase) {}

    public function build(): self
    {
        return $this->subject('Your Maseco subscription is active')->view('emails.subscription-purchased');
    }
}
