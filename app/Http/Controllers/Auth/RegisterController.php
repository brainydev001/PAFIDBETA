<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Avatar;
use App\Http\Traits\LogTrait;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Region;
use Carbon\Carbon;
use App\Models\OTP;
use App\Models\Role;
use App\Models\Staff;
use AfricasTalking\SDK\AfricasTalking;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    use LogTrait;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo ='dashboard_index';
    public function redirectTo()
    {
        // randomize a number between 10 -1000
        $digits = 5;
        $randomNumber = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
        // create user one time password
        $data = [
            'user_id' => auth()->user()->id,
            'otp' => $randomNumber,
            'verified' => false,
            'notified' => false
        ];

        // save otp data to otp table
        $otp = OTP::create($data);

        // send otp to user

        // user variables
        $sent_by = 'System';
        $numbers = auth()->user()->phone_number;
        $message = 'Your O.T.P is '.$otp->otp.'. Valid for 24hrs';
        $type = 'SMS';

        // send otp to user

        $this->otp($numbers, $message, $sent_by, $type);

        // otp check
        $id = auth()->user()->id;
        $check = OTP::where([
            ['user_id', '=', $id],
            ['verified', '=', false],
        ])->latest()->first();
        
        // otp id
        $otpId = OTP::where([
            ['user_id', '=', $id],
            ['verified', '=', false],
            // ['notified' => false]
        ])->pluck('id')->first();


        // using the id check on the staff table
        // get user type id
        $user_type = auth()->user()->staff_id;
        $type = Staff::find($user_type);
        $staff_name = $type->staff_name;

        // check if user is verified
        $verified = User::where(
            [ 
                ['id', '=', $id],
                ['is_approved', '=', true]
            ]
        )->latest()->first();

        // display otp sign in form
        if($check){
            return 'user-otp/'.$otpId . auth()->user()->username;
        }elseif(!$verified && !$check){
            return 'non-verified';    
        }elseif($verified && !$check && $staff_name == 'Managment'){
            // log details
            $origin = 'System Generated';
            $type = 'Login Access';
            $cluster_name = 'Login';
            $user_id = auth()->user()->id;
            $details = 'Access Granted';
            $this->log($origin, $type, $cluster_name, $user_id, $details);
            // compare the major types and redirect accordingly
            return 'main-manager' . auth()->user()->username;
        }elseif($verified && !$check && $staff_name == 'Staff'){
            // log details
            $origin = 'System Generated';
            $type = 'Login Access';
            $cluster_name = 'Login';
            $user_id = auth()->user()->id;
            $details = 'Access Granted';
            $this->log($origin, $type, $cluster_name, $user_id, $details);
            return 'main-manager' . auth()->user()->username; 
        }elseif($verified && !$check && $staff_name == 'R.C'){
            // log details
            $origin = 'System Generated';
            $type = 'Login Access';
            $cluster_name = 'Login';
            $user_id = auth()->user()->id;
            $details = 'Access Granted';
            $this->log($origin, $type, $cluster_name, $user_id, $details);
            return 'rc-dashboard' . auth()->user()->username; 
        }elseif($verified && !$check && $staff_name == 'A.C'){
            // log details
            $origin = 'System Generated';
            $type = 'Login Access';
            $cluster_name = 'Login';
            $user_id = auth()->user()->id;
            $details = 'Access Granted';
            $this->log($origin, $type, $cluster_name, $user_id, $details);
            return 'ac-dashboard' . auth()->user()->username; 
        }elseif($verified && !$check && $staff_name == 'F.C'){
            // log details
            $origin = 'System Generated';
            $type = 'Login Access';
            $cluster_name = 'Login';
            $user_id = auth()->user()->id;
            $details = 'Access Granted';
            $this->log($origin, $type, $cluster_name, $user_id, $details);
            return 'fc-dashboard' . auth()->user()->username; 
        }else{
            return 'logout' . auth()->user()->username; 
        };
    } 

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    // override show register to pass in variables
    public function showRegistrationForm()
    {
        $staffs = Staff::orderBy('id', 'desc')->get();
        $regions = Region::orderBy('id', 'desc')->get();
        return view('auth.register', compact(
            'staffs',
            'regions'
        ));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:25', 'unique:users'],
            'age' => ['required'],
            'gender' => ['required'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'county' => ['required', 'string', 'max:255'],
            'sub_county' => ['required', 'string', 'max:255'],
            'type_id' => ['required', 'integer'],
            'region_id' => ['required', 'integer'],
            'area_name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // handling images using sym link method
        $path = $data['photo']->store('public/user'); 
        

        // handle creating the age using carbon
        $age = explode('-', $data['age'])[0];
        $today = Carbon::now();
        $year = $today->year;
        $age =(int)$year - (int)$age;

        // user who created user
        $creator = User::where([
            ['first_name', '=', 'System'],
            ['last_name', '=', 'Administrator']
        ])->pluck('id')->first();

        // create O.T.P

        $user =  User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'age' => $age,
            'gender' => $data['gender'],
            'county' => $data['county'],
            'sub_county' => $data['sub_county'],
            'region_id' => $data['region_id'],
            'ward_name' => $data['area_name'],
            'photo' => $path,
            'created_by' => $creator,
            'staff_id' => $data['type_id'],
            'role_id' => $data['type_id'],
            'file_id' => $data['type_id'],
            'password' => Hash::make($data['password']),
        ]);

        $userId = $user->id;
        $staffId = $user->staff_id;
        // create an avatar record to d.b
        $avatar = Avatar::create([
            'user_id' => $userId,
            'file_path' => $path,
            'relation_id' => null,
            'is_stored_locally' => true
        ]);

        $avatarUpdate = User::find($userId);
        $roleUpdate = Staff::find($staffId);
        // update file_id to avatar object id
        $avatarUpdate->update([
            'file_id' => $avatar->id
        ]);
        // update role_id to roleUpdate object id
        $roleUpdate->update([
            'role_id' => $roleUpdate->role_id
        ]);
        // assign role
        $check = $user;
        $role = Role::find($roleUpdate->role_id);
        $check->attachRole($role->id);


        return $user;
    }

    // private function to send user the otp
    private function otp($numbers, $message, $sent_by, $type)
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

        $recipients = $result['data']->SMSMessageData->Recipients;

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

}
