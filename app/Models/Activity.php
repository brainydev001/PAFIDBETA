<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Activity extends Model
{
    use HasFactory;

    // mass assignment to table
    public $guarded = [];

    /**
     * Get region for a activity.
     */
    public function regions()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    /**
     * Get user reponsible for using model.
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get  files associated with the model.
     */
    public function files()
    {
        return $this->belongsTo(File::class, 'file_id');
    }


    /**
     * Get budget for a model.
     */
    public function budgets()
    {
        return $this->belongsTo(Budget::class, 'activity_id');
    }

    /**
     * Get requisition related to this model row.
     */
    public function requisitions()
    {
        return $this->belongsTo(Requisition::class, 'requisition_id');
    }

    /**
     * Get Payment related to this model row.
     */
    public function payments()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
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
        return $this->belongsTo(Signature::class, 'signature_id');  
    }

    /**
     * Get logs for this model row.
     */
    public function logs()
    {
        return $this->belongsTo(Log::class, 'log_id');  
    }

}
