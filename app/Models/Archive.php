<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;

    // mass assignment to table
    public $guarded = [];

    // item archived
    public function archives($model)
    {
        $modelItem = $this->model;

        if(isset($modelItem)){
            return $this->belongsTo($modelItem::class, 'item_id');  
        }else{
            $message = 'Model not set. Record not inserted in archives';
            return $message;
        }
        
    }

    /**
     * Get logs for this model row.
     */
    public function logs()
    {
        return $this->belongsTo(Log::class, 'log_id');  
    }

}
