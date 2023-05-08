<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    // mass assignment to table
    public $guarded = [];

    /**
     * Get region for a activity.
     */
    public function regions()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }

    /**
     * Get user reponsible for using model.
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'created_by');
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
     * Get activity for model.
     */
    public function activities()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
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
     * Get user who approved this model row.
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
