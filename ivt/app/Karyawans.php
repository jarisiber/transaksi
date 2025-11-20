<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawans extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'employment_status',
        'department',
        'position',
        'date_hired',
        'date_terminated',
        'created_by',
        'updated_by',
    ];
}