<?php

namespace App\Http\Controllers;

use App\Messages;
use App\User;
use App\Http\Requests\StorePesanRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function __construct(
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the ID of the currently authenticated user
        $userId = Auth::id();
        //
        $users = User::where('id', '!=', Auth::id())
                 ->pluck('name', 'id'); // Pluck ensures 'id' is the key and 'name' is the value
        // Load the relationship
        $pesan2 = Messages::where('to_user_id',$userId) // Filter by the logged-in user's ID
                ->with('user') // Load the 'user' relationship
                ->orderBy('created_at', 'ASC') // Order by creation date, newest first
                ->get();

        return view(
            'pesans.index',
            compact(
                'pesan2',
                'users'
            )
        );
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePesanRequest $request)
    {
        $data = $request->validated();
        $data['from_user_id'] = Auth::id(); // Set the sender to the logged-in user
        $data['to_user_id'] = $request->input('to_user_id'); // Ensure recipient ID is set from the form
        Messages::create($data);

        // --- EMAIL NOTIFICATION LOGIC ---
    
        // Define the recipient(s). Example: Send to a support team email address.
        $recipientEmail = 'jarisibertech@gmail.com';
        
        try {
            Mail::to($recipientEmail)->send(new NewTicketNotification($ticket));
        } catch (\Exception $e) {
            // Log the error but don't stop the user submission
            \Log::error('Gagal mengirim email untuk tiket ID: ' . $ticket->id . ' Error: ' . $e->getMessage());
            // You might want to flash a warning to the user here
            return redirect()->back()->with('warning', 'Tiket berhasil dibuat, tetapi gagal mengirim notifikasi email.');
        }
        // --- END EMAIL NOTIFICATION LOGIC ---

        return to_route('pesan.index')->with('success', 'Pesan berhasil dikirim!');
    }
    
    public function getDetailMessage($id)
    {
        // Find the message, ensuring it belongs to the logged-in user (Security!)
        $message = Messages::where('id', $id)
                            ->where('to_user_id', Auth::id())
                            ->with('user')
                            ->firstOrFail();
        // Mark the message as read if it's currently unread
        if (!$message->is_read) {
            $message->is_read = true;
            $message->save();
        }
        $recipientName = Auth::user()->name; // Assuming the recipient is the logged-in user
        // Return the message details as JSON
        return response()->json([
            'subject' => $message->subject,
            // *** Apply nl2br() here to convert \n to <br> for HTML display ***
            'body' => nl2br(e($message->message_text)), // Escape HTML to prevent XSS
            'sender' => $message->user->name ?? 'Unknown User',
            'to' => $recipientName ?? 'Unknown User',
            'date' => $message->created_at->format('d F Y, H:i') . ' WIB', // Format the date nicely
            'sender_id' => $message->from_user_id, // Include sender ID for reply purposes
            'recipient_id' => $message->to_user_id, // Include recipient ID for reply purposes
        ]);
        
    }

    public function toggleReadStatus($id)
    {
        // Find the message (security check remains crucial)
        $message = Messages::where('id', $id)
                            ->where('to_user_id', Auth::id())
                            ->firstOrFail();

        // Toggle the status
        $message->is_read = !$message->is_read;
        $message->save();

        // Return a success response
        return response()->json([
            'success' => true,
            'is_read' => $message->is_read,
            'message' => $message->is_read ? 'Message marked as read.' : 'Message marked as unread.',
        ]);
    }
}
