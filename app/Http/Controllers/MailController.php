<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\BankMail;
use App\Models\Activity;
use App\Models\Farmer;
use App\Models\User;
use Illuminate\Support\Facades\Mail as FacadesMail;

class MailController extends Controller
{
    //
    public function index($type)
    {
        if($type == 'Staff')
        {
            $users = User::all();

            return view('admin.email.index', compact(
                'users'
            ));
        }else{
            $datas = Activity::all();
            return view('admin.email.activities', compact(
                'datas'
            ));
        }
    }

    // get attendend farmers
    public function farmerAttendance($id)
    {
        $activity = Activity::find($id);

        $farmer = Farmer::where([
            ['ward_name', '=', $activity->area_name]
        ])->get(); 

        $users = [];

        if($farmer){
            foreach($farmer as $d){
                $f = $d->attendance()->where('activity_id', $id)->get();
                array_push($users, $f);
            }
        }
        // dd($users);
        return view('admin.email.farmer_list', compact(
            'activity',
            'users'
        ));
    }

    public function create(Request $request)
    {
        $numbers = [];
        if (count($request['number']) > 0) {
            #
            foreach ($request['number'] as $key => $value) {
                  $data = $value;
                  array_push($numbers, $data);
            }
        } else {
            # code...
            return back()->with('warning-message', 'Email Not Sent. Select Phone numbers on CHECKLIST and Try Again');
        }
        // mail data
        $mailData = [
            'title' => 'PAFID to Bank Email',
            'body' => $request->get('message'),
            'amount' => $request->get('amount'),
            'phone_number' => $numbers
        ];

        $check = Mail::to('pafid.information@gmail.com')->send(new BankMail($mailData));
        
        if ($check) {
            # code...
            return back()->with('success-message', 'Email Sent Successfully');
        } else {
            # code...
            return back()->with('warning-message', 'Email Not Sent. Please Try Again');
        }
        
    }

}
