<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WeeklyTicketReport extends Mailable
{
    use Queueable, SerializesModels;

    public $tickets;

    /**
     * Create a new message instance.
     *
     * @param \Illuminate\Support\Collection $tickets
     * @return void
     */
    public function __construct($tickets)
    {
        $this->tickets = $tickets;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pengingat Tugas Mingguan - ' . now()->format('d-m-Y'))
                    ->markdown('emails.tickets.weekly_report', [
                        'tickets' => $this->tickets
                    ]);
    }
}
