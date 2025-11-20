<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id','conversation_id', 'from_user_id', 'to_user_id', 'message_text', 'subject', 'is_read', 'created_at', 'updated_at'
    ];

    public function user()
    {
        // Assuming 'from_user_id' is the column that stores the ID of the SENDER
        return $this->belongsTo(User::class, 'from_user_id');
    }
}
