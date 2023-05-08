<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    // mass assignment to table
    public $guarded = [];

    /**
     * Get activity for model.
     */
    public function activities()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }
    
    /**
     * Get per diemm for model.
     */
    public function pdms()
    {
        return $this->belongsTo(PDM::class, 'event_id');
    }

    /**
     * Get requisition related to this model row.
     */
    public function requisitions()
    {
        return $this->belongsTo(Requisition::class, 'requisition_id');
    }

    /**
     * Get proof related to this model row.
     */
    public function proofs()
    {
        return $this->belongsTo(Proof::class, 'proof_id');
    }

    /**
     * Get signature associated with this model row.
     */
    public function signatures()
    {
        return $this->belongsTo(Signature::class, 'signature_id');  
    }

    /**
     * Get file associated with this model row.
     */
    public function files()
    {
        return $this->belongsTo(File::class, 'file_id');  
    }

    /**
     * Get farmer associated with this model row.
     */
    public function farmer()
    {
        return $this->belongsTo(Farmer::class, 'user_id');  
    }

    /**
     * Get user associated with this model row.
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'confirmed_by');  
    }

    /**
     * Get attendance related to this model row.
     */
    public function attendance()
    {
        return $this->belongsTo(Farmer::class, 'user_id');
    }

    /**
     * Get user who confirmed this model row.
     */
    public function confirmedBy()
    {
        return $this->belongsTo(User::class, 'confirmed_by');  
    }

    /**
     * Get logs for this model row.
     */
    public function logs()
    {
        return $this->belongsTo(Log::class, 'log_id');  
    }
}
