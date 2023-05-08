<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proof extends Model
{
    use HasFactory;

    // mass assignment to for this model row
    public $guarded = [];

    /**
     * Get Proof for this model row.
     */
    public function proofs()
    {
        return $this->belongsTo(Proof::class, 'related_proof_id');
    }

    /**
     * Get Activity for this model row.
     */
    public function activities()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }
    
    /**
     * Get budget for this model row.
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
     * Get user who confirmed this model row.
     */
    public function confirmedBy()
    {
        return $this->belongsTo(User::class, 'confirmed_by');  
    }

    /**
     * Get user who disbursed this model row.
     */
    public function disbursedBy()
    {
        return $this->belongsTo(User::class, 'disbursed_by');  
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
