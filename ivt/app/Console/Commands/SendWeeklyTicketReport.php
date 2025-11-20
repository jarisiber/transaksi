<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Ticket; // Assuming your Ticket model is here
use App\Mail\WeeklyTicketReport; // The Mailable class you'll create

class SendWeeklyTicketReport extends Command
{
    /**
     * The name and signature of the console command.
     * Use this to call the command: php artisan report:tickets-weekly
     * @var string
     */
    protected $signature = 'report:tickets-weekly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a list of all tickets (jenis_dukungan & judul) every Tuesday.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // 1. Fetch the necessary ticket data
        // You might want to filter this by tickets created in the last week, or just all open tickets.
        // For simplicity, this example fetches all tickets.
        $tickets = Ticket::select('jenis_dukungan', 'judul','departemen','branch','created_at','no_tiket')
                         ->where('status', 1) // Assuming '1' means open
                         ->orderBy('created_at', 'desc')
                         ->get();

        // 2. Check if there are tickets to report
        if ($tickets->isEmpty()) {
            $this->info('No tickets found to report this week.');
            return 0;
        }

        // 3. Send the Mailable with the fetched data
        $recipientEmails = [
            'wahid.asimetris@gmail.com',
            'abdur.rahman@nusantara-group.com',
        ]; // Change this to the actual recipients
        
        Mail::to($recipientEmails)->send(new WeeklyTicketReport($tickets));

        $this->info("Weekly ticket report (Open, Pembelian only) successfully sent to " . implode(', ', $recipientEmails) . ".");

        return 0;
    }
}
