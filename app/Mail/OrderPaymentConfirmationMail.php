<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPaymentConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $order) {}

    public function build(): self
    {
        return $this->subject('Payment received for order #' . $this->order->id)->view('emails.order-payment-confirmation');
    }
}
