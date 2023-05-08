<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use HasFactory;

    // mass assignment to table
    public $guarded = [];

    /**
     * Get user for this  model.
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
