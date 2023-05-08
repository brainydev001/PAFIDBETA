<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PDM extends Model
{
    use HasFactory;

    // mass assignment to table
    public $guarded = [];
    
    /**
     * Get requisition for model.
     */
    public function requisitions()
    {
        return $this->belongsTo(Requisition::class, 'requisition_id');
    }

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
     * Get signature associated with this model row.
     */
    public function signatures()
    {
        return $this->belongsTo(Signature::class, 'file_id');  
    }

    /**
     * Get file associated with this model row.
     */
    public function files()
    {
        return $this->belongsTo(File::class, 'file_id');  
    }

    /**
     * Get logs for this model row.
     */
    public function logs()
    {
        return $this->belongsTo(Log::class, 'log_id');  
    }

    /**
     * Get user for this model row.
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');  
    }
}
