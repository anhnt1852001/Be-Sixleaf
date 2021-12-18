<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketNotification extends Notification
{
    use Queueable;


    public function __construct($data)
    {
        $this->ticket_code = $data['ticket_code'];
        $this->customer_name = $data['customer_name'];
    }


    public function via($notifiable)
    {
        return ['database'];
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }


    public function toArray($notifiable)
    {
        return [
            'ticket_code' => $this->ticket_code,
            'customer_name' => $this->customer_name
        ];
    }
}
