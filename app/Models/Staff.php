<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    // mass assignment to table
    public $guarded = [];

    /**
     * Get user who created this model row.
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');  
    }

    /**
     * Get user who examined this model row.
     */
    public function examinedBy()
    {
        return $this->belongsTo(User::class, 'examined_by');  
    }

    /**
     * Get user who approved this model row.
     */
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');  
    }

    /**
     * Get user who rejected this model row.
     */
    public function rejectedBy()
    {
        return $this->belongsTo(User::class, 'rejected_by');  
    }

    /**
     * Get logs for this model row.
     */
    public function logs()
    {
        return $this->belongsTo(Log::class, 'log_id');  
    }
}
