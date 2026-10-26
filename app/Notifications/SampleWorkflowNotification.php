<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SampleWorkflowNotification extends Notification
{
    use Queueable;

    public function __construct(private string $event, private string $message, private ?string $url = null) {}

    public function via($notifiable): array { return ['database']; }

    public function toArray($notifiable): array
    {
        return ['event'=>$this->event,'message'=>$this->message,'url'=>$this->url];
    }
}
