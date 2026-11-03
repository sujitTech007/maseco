<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KycUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public $account,
        public string $accountType,
        public string $status,
        public ?string $adminNote = null,
    ) {
    }

    public function build(): self
    {
        $statusDetails = match ($this->status) {
            'pending' => [
                'subject' => 'KYC documents received | Maseco',
                'title' => 'Your documents are under review',
                'message' => 'We received your KYC documents. Our team will review them and email you when there is an update.',
                'action' => 'View verification status',
            ],
            'approved' => [
                'subject' => 'KYC verification approved | Maseco',
                'title' => 'Your account is verified',
                'message' => 'Your KYC verification is approved. You can now access your account dashboard and its features.',
                'action' => 'Open your dashboard',
            ],
            default => [
                'subject' => 'KYC documents need updates | Maseco',
                'title' => 'Please update your KYC documents',
                'message' => 'Our team could not approve your KYC submission. Review the note below, update your documents, and submit them again.',
                'action' => 'Update your KYC',
            ],
        };

        $routeName = match ([$this->accountType, $this->status]) {
            ['supplier', 'approved'] => 'seller.dashboard',
            ['manufacturer', 'approved'] => 'manufacturer.dashboard',
            ['user', 'approved'] => 'user.dashboard',
            ['supplier', default] => 'seller.kyc',
            ['manufacturer', default] => 'manufacturer.kyc',
            default => 'user.kyc',
        };

        return $this->subject($statusDetails['subject'])
            ->view('emails.kyc-update', [
                'account' => $this->account,
                'status' => $this->status,
                'title' => $statusDetails['title'],
                'message' => $statusDetails['message'],
                'actionLabel' => $statusDetails['action'],
                'actionUrl' => route($routeName),
                'adminNote' => $this->adminNote,
            ]);
    }
}
