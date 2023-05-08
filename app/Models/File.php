<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    // mass assignment to table
    public $guarded = [];
    
    /**
     * Get user for this model row.
     */
    public function users()
    {
        return $this->belongsTo(user::class, 'user_id');
    }

    /**
     * Get file related to this model row.
     */
    public function fileRelation()
    {
        return $this->belongsTo(File::class, 'file_relation_id');
    }

    /**
     * Get logs for this model row.
     */
    public function logs()
    {
        return $this->belongsTo(Log::class, 'log_id');  
    }
}
