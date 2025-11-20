<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\User;
use App\CommodityLocation;
use App\Karyawans;
use App\Http\Requests\StoreTicketRequest;
use App\Repositories\TiketRepository;
use App\Notifications\TicketNotification;
use App\Notifications\TicketCloseNotification;
use App\Mail\NewTicketNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    public function __construct(
        private TiketRepository $tiketRepository,
    ) 
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Make Barcode object of Code128 encoding.
        $barcode = (new \Picqer\Barcode\Types\TypeCode39())->getBarcode('081385229903');
        // Output the barcode as HTML in the browser with a HTML Renderer
        $renderer = new \Picqer\Barcode\Renderers\HtmlRenderer();

        $branches = CommodityLocation::orderBy('name')->pluck('name', 'id');
        $karyawans = Karyawans::pluck('first_name', 'email')->toArray();
        
        $tiket_count_all = $this->tiketRepository->countTiketAll()->map(function ($tiket) {
            return collect([
                'no_tiket' => $tiket->no_tiket,
                'count' => $tiket->count,
            ]);
        });

        $tiket_status_count = $this->tiketRepository->countTicketStatus('status')->map(function ($tiket) {
            return collect([
                'status' => $tiket->status,
                'count' => $tiket->count,
            ]);
        });
        $tiket_pembelian_total = Ticket::where('jenis_dukungan', 'Pembelian')
            ->where('status', 1)
            ->count();

        $tiket_counts = [
            'tiket_in_total' => $tiket_count_all->sum('count') ?? 0,
            'tiket_close_total' => $tiket_status_count->firstWhere('status', 0)['count'] ?? 0,
            'tiket_open_total' => $tiket_status_count->firstWhere('status', 1)['count'] ?? 0,
            'tiket_pembelian_total' => $tiket_pembelian_total ?? 0,
        ];

        // Eager load the 'user' relationship
        $tiket = Ticket::with('user')
                ->orderBy('status', 'DESC')
                ->orderBy('no_tiket', 'ASC')
                ->get();
        
        return view(
            'tikets.index', 
            compact(
                'tiket',
                'tiket_counts',
                'branches',
                'barcode',
                'renderer',
                'karyawans'
            )
        );
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $validatedData = $request->validated();
        // The email_notification field from the form is the recipient's email
        $recipientEmail = $validatedData['email_notification'];
        // Start a database transaction for atomicity
        DB::beginTransaction();

        try {
            $now = Carbon::now();
            $yearMonthDay = $now->format('ymd'); // Format: YYMMDD

            // Get the last ticket number for the current month
            // $lastTicket = Ticket::where('no_tiket', 'like', $yearMonthDay . '-%')
            $lastTicket = Ticket::where('no_tiket', 'like', $yearMonthDay . '%')
                ->orderBy('no_tiket', 'desc')
                ->first();

            $nextNumber = 1; // Default starting number

            if ($lastTicket) {
                // Extract the numeric part after the date and increment
                $lastNumber = intval(substr($lastTicket->no_tiket, 6)); // Skip YYMMDD
                $nextNumber = $lastNumber + 1;
            }

            // Format the next number with leading zeros
            $formattedNumber = sprintf('%04d', $nextNumber); // 4 digits

            // Create the ticket number
            // $noTiket = $yearMonthDay . '-' . $formattedNumber;
            $noTiket = $yearMonthDay . $formattedNumber;

            // Create the ticket
            $ticket = new Ticket($validatedData);
            $ticket->no_tiket = $noTiket;

            // Set the dibuat_oleh field to the ID of the logged-in user
            $ticket->dibuat_oleh = Auth::id(); // Get the ID of the authenticated user

            $ticket->save();

            DB::commit(); // Commit the transaction
            // Send Email Notification
            $messages["hi"] = "Hello, {$ticket->email_notification}";
            $messages["wish"] = "Kami telah membuat tiket untuk permintaan Anda, kami akan menanggapi permintaan Anda segera.";
            $messages["ticket_number"] = $ticket->no_tiket;
            $messages["ticket_issue"] = $ticket->judul;
            $user = new User();
            $user->email = $recipientEmail;
            $user->name = $ticket->nama_karyawan;
            // Ambil nama pembuat tiket
            $creatorName = auth()->user()->name;
            $user->notify(new TicketNotification($messages, $creatorName));
            // Mail::to($recipientEmail)->send(new NewTicketNotification($ticket));
            return to_route('tiket.index')->with('success', 'Data berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction on error
            throw $e; // Re-throw the exception to be handled elsewhere
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function tutupTiket(Request $request, $id)
    {
        // Validate the incoming data, including the new 'rating' field
        $request->validate([
            'status' => 'required|integer|in:0',
            'rating' => 'required|integer|between:1,5',
        ]);

        $ticket = Ticket::findOrFail($id);
        
        // Update the ticket status and rating
        $ticket->status = $request->input('status');
        $ticket->rating = $request->input('rating');
        $ticket->closed_at = now();
        $ticket->save();

        // --- START Email Notification Logic ---

        // 1. Define the recipient email address, pulled from the ticket data
        $recipientEmail = $ticket->email_notification;
            
        // 2. Prepare the notification messages
        $messages["hi"] = "Hello, {$ticket->nama_karyawan}";
        $messages["wish"] = "Kami telah melakukan permintaan Anda, dan tiket sudah kami tutup dan Anda menilai dengan rating {$ticket->rating}/5.";
        $messages["ticket_number"] = $ticket->no_tiket;
        $messages["ticket_issue"] = $ticket->judul;
        $messages["ticket_rating"] = $ticket->rating;
        // 3. Create a new User instance to represent the recipient
        $user = new User();
        $user->email = $recipientEmail;
        // $user->name = $ticket->nama_karyawan;
        // 4. Send the notification
        $user->notify(new TicketCloseNotification($messages));
        // --- END Email Notification Logic ---
        
        // Redirect back to the ticket index with a success message.
        return to_route('tiket.index')->with('success', 'Tiket Berhasil ditutup!');
    }

    /**
     * Generate PDF for a specific resource.
     */
    public function generatePDFSatuTiket($id)
    {
        $this->authorize('print satu tiket');

        $ticket = Ticket::find($id);
        $jaris = env('NAMA_APLIKASI', '....');
        $pdf = Pdf::loadView('tikets.pdfone', compact(['ticket', 'jaris']))->setPaper('a4');

        return $pdf->download('adr-tiket.pdf');
    }

    public function addComment(Request $request, $id)
    {
        $request->validate([
            'comment_text' => 'required|string',
        ]);
    
        $ticket = Ticket::findOrFail($id);
    
        // Create a new comment associated with the ticket
        $ticket->comments()->create([
            'comment' => $request->input('comment_text'),
        ]);
    
        return to_route('tiket.index')->with('success', 'Komentar berhasil ditambahkan!');
    }
    
    // Example method to get ticket details with caching
    public function getTicketDetails($ticketId)
    {
        // Define a unique cache key based on the ticket ID
        $cacheKey = 'ticket_details_' . $ticketId;

        // Attempt to retrieve data from the cache. If it doesn't exist, execute the callback.
        $ticket = Cache::remember($cacheKey, now()->addMinutes(59), function () use ($ticketId) {
            // Query the database if cache misses
            return Ticket::with('comments')->findOrFail($ticketId); 
        });

        // Return the data as JSON to your frontend
        return response()->json($ticket);
    }

    public function ticketNotify(Request $request)
    {
        $user = User::find(1);
        $messages["hi"] = "Hey, {$user->name}";
        $messages["wish"] = "Kami telah membuat tiket untuk permintaan Anda, kami akan segera menanggapi permintaan Anda.";
        $user->notify(new TicketNotification($messages));
        // return to_route('tiket.index')->with('success', 'Data berhasil ditambahkan!');
    }
}
