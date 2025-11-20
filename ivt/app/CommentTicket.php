<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentTicket extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'ticket_id',
        'comment',
        'created_by',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
