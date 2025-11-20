<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Tickets;

class TicketNotification extends Notification
{
    use Queueable;

    private $messages;
    private $creatorName;
    /**
     * Create a new notification instance.
     */

    public function __construct($messages, String $creatorName)
    {
        $this->messages = $messages;
        $this->creatorName = $creatorName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Ticket Created: ' . $this->messages['ticket_number'])
            ->line($this->messages['hi'])
            // ->line($this->messages['wish'])
            // ->line('Ticket Number: **' . $this->messages['ticket_number'] . '**')
            // ->line('Issue: **' . $this->messages['ticket_issue'] . '**')
            // ->line('Terima kasih, dan jangan ragu untuk menghubungi kami jika Anda memiliki pertanyaan!')
            // ->line('E-mail ini dibuat secara otomatis, mohon tidak membalas. Jika butuh bantuan, silakan hubungi Tim IT.');

            // Using markdown template for better formatting
            ->markdown('emails.tickets.new-ticket', [
                'messages' => (object) $this->messages,
                'creatorName' => $this->creatorName,
            ]);
    }  

    /**
     * Get the array representation of the notification.
     *
     * @return array
     */

    public function toArray(object $notifiable): array
    {
        return [
        ];
    }
}
