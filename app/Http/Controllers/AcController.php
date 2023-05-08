<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcController extends Controller
{
    //return ac dashboard
    public function index()
    {
        return view('AC.index');
    }
}
