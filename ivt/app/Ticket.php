<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'no_tiket', 'email', 'departemen', 'priority', 'judul', 'status', 
        'ditutup_oleh', 'description', 'branch', 'created_at', 'updated_at', 'jenis_dukungan', 'email_notification'
    ];
    protected $casts = [
        'status' => 'integer',
    ];

    public function getStatusName()
    {
        return match ($this->status) {
            1 => 'Open',
            2 => 'Closed',
            3 => 'Cancel',
            default => null
        };
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    public function comments()
    {
        return $this->hasMany(CommentTicket::class);
    }
}
