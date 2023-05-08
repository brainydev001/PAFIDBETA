<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    //gets the welcome blade
    public function landing()
    {
        return view('welcome');
    }
}
