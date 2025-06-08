<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RaportReminder extends Notification
{
    use Queueable;
    public function toDatabase($notifiable) {
        return [
            'Title' => 'Tytul',
            'Message' => 'Wiadomosc',
        ];
    }
}
