<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SysInfoController extends Controller
{
    //return user to verification page
    public function NanVerify()
    {
        return view('info.verify');
    }
}
