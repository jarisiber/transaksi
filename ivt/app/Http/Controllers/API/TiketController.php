<?php

namespace App\Http\Controllers\API;

use App\Ticket;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class TiketController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        $ticket = Ticket::where('id', $ticket->id)
            // Eager load the 'user' (for 'dibuat_oleh')
            ->with('user')
            // Eager load the 'comments' relationship and apply the ASCENDING sort
            ->with([
                'comments' => function ($query) {
                    // ASCENDING sort: oldest comments first
                    $query->orderBy('created_at', 'asc'); 
                }
            ])
            ->firstOrFail();

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
            'data' => $ticket,
        ], Response::HTTP_OK);
    }

}
