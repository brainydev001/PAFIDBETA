<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use App\Models\User;
use Illuminate\Http\Request;

class ManagmentController extends Controller
{
    /**
     * Function to control booting and rebooting
     * Functions are grouped.
     * Groups are in order in such a way that functions list is:
     * Access public, Access private, Reusable, Logs, Communication, Analysis, Reporting.
     * A definitive explanation is provided.
     * Models/Classes can be passed dynamically.
     * Big O Notation to be the main condition to relationships.
     * Relationships are as definitive as possible.
     * Relationship list:
     *  1) One to Many(Inverse).
     *  2) Function Relationship to the second node.
     *  3) Class Inheritance.
     *  
     */

    // PUBLIC ACCESS FUNCTIONS
    
    // to dashboard based on type.
    public function index()
    {
        // declare log variables.
        // $origin = $type;

        // #1.Code syntax to control data flow and redirects
        

        // #2. Objects to compact.

        //  #4. Session messages declaration

        // #5. Return value
        return view('admin.managment.access.index');
    }

    
}
