<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    // mass assignment to table
    public $guarded = [];
    
    /**
     * Get user for this  model.
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get logs for this model row.
     */
    public function logs()
    {
        return $this->belongsTo(Log::class, 'log_id');  
    }

}
