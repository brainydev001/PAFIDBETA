<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FcController extends Controller
{
    //return fc dashboard
    public function index()
    {
        return view('FC.index');
    }
}
