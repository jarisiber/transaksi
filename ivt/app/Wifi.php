<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wifi extends Model
{
    use HasFactory;

    protected $casts = [
        'is_active' => 'integer',
    ];

    /**
     * Get the name of the condition based on the condition code.
     */
    public function getWifiCondition()
    {
        return match ($this->is_active) {
            0 => 'In-Active',
            1 => 'Active',
            2 => 'NA',
            default => null
        };
    }
}
