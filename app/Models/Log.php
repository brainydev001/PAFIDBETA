<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
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

    /**
     * Get log associated with this model row.
     */
    public function logs()
    {
        return $this->belongsTo(Log::class, 'relation_log_id');  
    }

    /**
     * Get file associated with this model row.
     */
    public function files()
    {
        return $this->belongsTo(File::class, 'file_id');  
    }

    /**
     * Get Payment related to this model row.
     */
    public function payments()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    /**
     * Get budget for a model.
     */
    public function budgets()
    {
        return $this->belongsTo(Budget::class, 'activity_id');
    }

    /**
     * Get activity for model.
     */
    public function activities()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }

    /**
     * Get requisition related to this model row.
     */
    public function requisitions()
    {
        return $this->belongsTo(Requisition::class, 'requisition_id');
    }
}
