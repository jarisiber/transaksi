<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pc extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','jenis', 'merk', 'user_responsible', 'hostname', 'is_active', 'processor', 'ram', 
        'branch_name'
    ];
}
