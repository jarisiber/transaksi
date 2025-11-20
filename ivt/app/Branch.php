<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $casts = [
        'is_active' => 'integer',
    ];

    protected $fillable = [
        'id','nama_branch', 'alamat', 'isp', 'no_inet', 'email_digunakan', 'is_active', 'keterangan', 'created_at', 'update_at',
    ];

    /**
     * Get the name of the condition based on the condition code.
     */
    public function getBranchCondition()
    {
        return match ($this->is_active) {
            0 => 'Close',
            1 => 'Open',
            2 => 'Multibrand',
            default => null
        };
    }
}
