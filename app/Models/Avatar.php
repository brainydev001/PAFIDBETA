<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use HasFactory;

    // mass assignment to table
    public $guarded = [];

    /**
     * Get file associated with this model row.
     */
    public function files()
    {
        return $this->belongsTo(File::class, 'file_id');  
    }

    /**
     * Get user associated with this model row.
     */
    public function users()
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
