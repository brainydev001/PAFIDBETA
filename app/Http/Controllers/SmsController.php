<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;
use App\Models\User;

    // sms function
    function send_sms($numbers, $message, $sent_by, $type)
    {
        $username = 'Pafid'; // use 'sandbox' for development in the test environment
        $apiKey   = 'f4b9558dd3f02f406d5f1146c9089ffb9bbea9e1ccbaed99af208f3703d472d1'; // use your sandbox app API key for development in the test environment
        $AT       = new AfricasTalking($username, $apiKey);

        // Initialize the SDK

        // Get one of the services
        $sms      = $AT->sms();

        // Use the service
        $result   = $sms->send([
            'to'      => $numbers,
            'message' => $message
        ]);

        // $recipients = $result['data']->SMSMessageData->Recipients;

        // foreach ($recipients as $item) {
        //     $delivery_report = new SmsReport([
        //         'number' => $item->number,
        //         'status' => $item->status,
        //         'type' => $type,
        //         'message' => $message,
        //         'sent_by' => $sent_by
        //     ]);
        //     $delivery_report->save();
        // }
    }

class SmsController extends Controller
{

    //main sms manager page admin
    public function index()
    {
        $users = User::all();
        $county = User::all()->unique('county');
        $sub_county = User::all()->unique('sub_county');
        $region = User::all()->unique('region_id');
        // SMS balance
        $username = 'Pafid'; // use 'sandbox' for development in the test environment
        $apiKey   = 'f4b9558dd3f02f406d5f1146c9089ffb9bbea9e1ccbaed99af208f3703d472d1'; // use your sandbox app API key for development in the test environment
        $AT       = new AfricasTalking($username, $apiKey);

        $application = $AT->application();
        $data = $application->fetchApplicationData();

        // real sms balance
        $real = explode(" ", $data['data']->UserData->balance);
        // 1 bob per SMS balance
        $airtime = $real[1] / 0.8;

        return view('admin.sms.smsmanager', compact(
            'users',
            'county',
            'sub_county',
            'region',
            'airtime'
        ));
    }

    // send to all members script
    public function send_to_all(Request $request)
    {
        // get type of users receiving sms
        $type = $request->get('type');
        $message = $request->get('message');
        $sent_by = $request->get('sent_by');

        $numbers = User::pluck('phone_number')->toArray();

        // send sms function
        send_sms($numbers, $message, $sent_by, $type);

        return redirect()->back()->with('success-message', 'SMS successfully sent to all users');

        return $numbers;
    }

    // send to specific group,district,age group, registered or unregistered members script
    public function send_to_specific(Request $request)
    {
        // get type of users receiving sms
        $type = $request->get('type');
        $message = $request->get('message');
        $sent_by = $request->get('sent_by');

        // send to users with same county
        if ($type == 'county') {
            $numbers = User::where('county', $request->get('selection'))->pluck('phone_number')->toArray();
            // send sms function
            send_sms($numbers, $message, $sent_by, $type);

            return redirect()->back()->with('success-message', 'SMS successfully sent to members of ' . $request->get('selection') . ' county');
        }

        // send to users with same sub county
        if ($type == 'sub_county') {
            $numbers = User::where('sub_county', $request->get('selection'))->pluck('phone_number')->toArray();
            // send sms function
            send_sms($numbers, $message, $sent_by, $type);

            return redirect()->back()->with('success-message', 'SMS successfully sent to members of ' . $request->get('selection') . ' sub county');
        }

        // send to users with same region
        if ($type == 'region') {
            $numbers = User::where('region_id', $request->get('selection'))->pluck('phone_number')->toArray();
            
            // send sms function
            send_sms($numbers, $message, $sent_by, $type);

            return redirect()->back()->with('success-message', 'SMS successfully sent to region members');
        }

        // send to unregistered users
        if ($type == 'unreg') {
            $numbers = str_replace(" ", "", $request->get('number'));
            // check for comma for multiple number entry
            $comma = ',';
            $check_comma = strpos($numbers, $comma);

            if ($check_comma !== false) {
                $numbers = explode(',', $numbers);
            } else {
                $numbers = [$numbers];
            }
            // send sms function
            send_sms($numbers, $message, $sent_by, $type);

            return redirect()->back()->with('success-message', 'SMS successfully sent to user(s)');
        }

        // send to registered members
        if ($type == 'members') {
            $numbers = $request->get('number');
            // send sms function
            send_sms($numbers, $message, $sent_by, $type);

            return redirect()->back()->with('success-message', 'SMS successfully sent to member(s)');
        }
    }

    // sms members table page
    public function sms_members()
    {
        $users = User::all();

        return view('admin.sms.smsmembers', compact(
            'users'
        ));
    }
}
