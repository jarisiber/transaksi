<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketCloseNotification extends Notification
{
    use Queueable;
    private $messages;
    /**
     * Create a new notification instance.
     */
    public function __construct($messages)
    {
        $this->messages = $messages;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        // $this->messages holds the array you passed when instantiating the class
        return (new MailMessage)
            ->subject('Ticket Closed: ' . $this->messages['ticket_number'])
            ->greeting($this->messages['hi'])
            // ->line($this->messages['wish'])

            // ->line('Ticket Number: **' . $this->messages['ticket_number'] . '**')
            // ->line('Issue: **' . $this->messages['ticket_issue'] . '**')

            // ->action('Detail Tiket', url('/tickets/' . $this->messages['ticket_number'])) // Example action link
            // ->line('Terima kasih atas perhatian dan kerjasamanya!')
            // ->line('E-mail ini dibuat secara otomatis, mohon tidak membalas. Jika butuh bantuan, silakan hubungi Tim IT.');
            ->markdown('emails.tickets.close-ticket', [
                'messages' => (object) $this->messages,
            ]);

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
