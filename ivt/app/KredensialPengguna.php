<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KredensialPengguna extends Model
{
    use HasFactory;
	
	protected $fillable = [
        'id','nama_pengguna', 'nik', 'branch', 'jabatan', 'email', 'hp', 'keterangan',
    ];
}
