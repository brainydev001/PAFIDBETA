<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\OTP;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LogsController extends Controller
{
    //returns log index page
    public function index()
    {
        $logs = Log::orderBy('id', 'desc')->get();

        return view('admin.logs.index', compact(
            'logs'
        ));
    }

    public function otpLogs()
    {
        $otps = OTP::orderBy('id', 'desc')->get();

        return view('admin.otp.index', compact(
            'otps'
        ));
    }

    // returns to index with normalized data
    public function logFilter(Request $request)
    {
        $start_date = Carbon::parse($request['start_date'])->toDateTimeString();
        $end_date = Carbon::parse($request['end_date'])->toDateTimeString();

        // date filter logic
        $logs = Log::whereBetween('created_at', [$start_date, $end_date])->get();

        return view('admin.logs.index', compact(
            'logs'
        ))->with('success-message', 'Filter showing logs from '.$start_date.' to '.$end_date);

        // return redirect('index');
    }
}
