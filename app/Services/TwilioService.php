<?php

namespace App\Services;

use Twilio\Rest\Client;

class TwilioService
{
    protected $client;
    protected $from;

    public function __construct()
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $this->from = env('TWILIO_FROM');
        $this->client = new Client($sid, $token);
    }

    public function sendOtp($to, $otp)
    {
        return $this->client->messages->create($to, [
            'from' => $this->from,
            'body' => "Your OTP code is: $otp"
        ]);
    }
}
