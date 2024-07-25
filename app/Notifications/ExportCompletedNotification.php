<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ExportCompletedNotification extends Notification
{
    use Queueable;

    protected $fileUrl;

    public function __construct($fileUrl)
    {
        $this->fileUrl = $fileUrl;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The export of GitHub repositories has been completed.')
            ->action('Download Export', $this->fileUrl)
            ->line('Thank you for using our application!');
    }
}
