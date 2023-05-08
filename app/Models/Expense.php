<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    // mass assignment to table
    public $guarded = [];

    /**
     * Get the user who created this expense.
     */
    public function expenseUser()
    {
        return $this->belongsTo(User::class, 'created_by');  
    }

}
