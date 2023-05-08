<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RcController extends Controller
{
    //return rc dashboard
    public function index()
    {
        return view('RC.index');
    }
}
