<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function index()
    {
        $users = User::onlyTrashed()->orderBy('id', 'desc')->get();

        return view('admin.archives.index', compact(
            'users'
        ));
    }
}
