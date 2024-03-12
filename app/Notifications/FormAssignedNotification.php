<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FormAssignedNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Form Assigned Notification')
            ->line('A form has been assigned to you.')
            ->action('View Form', url('/monitoring-sheets'))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            // Additional data to be sent with the notification
        ];
    }
}
