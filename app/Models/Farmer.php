<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
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
     * Get activity for model.
     */
    public function activities()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }

    /**
     * Get  files associated with the model.
     */
    public function files()
    {
        return $this->belongsTo(File::class, 'file_id');
    }


    /**
     * Get area for a model.
     */
    public function areas()
    {
        return $this->belongsTo(area::class, 'activity_id');
    }

    /**
     * Get Payment related to this model row.
     */
    public function payments()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    /**
     * Get Payment related to this model row.
     */
    public function farmerPaymentRelation()
    {
        return $this->belongsTo(Farmer::class, 'payment_relation_id');
    }


    /**
     * Get fc related to this model row.
     */
    public function fcs()
    {
        return $this->belongsTo(User::class, 'fc_id');
    }

    /**
     * Get attendance related to this model row.
     */
    public function attendance()
    {
        return $this->hasOne(Attendance::class, 'user_id', 'id');
    }

    /**
     * Get user who created this model row.
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'fc_id');  
    }


    /**
     * Get user who archived this model row.
     */
    public function archivedBy()
    {
        return $this->belongsTo(User::class, 'archived_by');  
    }

    /**
     * Get user who restored this model row.
     */
    public function restoredBy()
    {
        return $this->belongsTo(User::class, 'restored_by');  
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
