<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\LogTrait;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Models\OTP;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    use LogTrait;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    public function redirectTo()
    {
        // otp check
        $id = auth()->user()->id;
        $check = OTP::where([
            ['user_id', '=', $id],
            ['verified', '=', false]
        ])->latest()->first();

        // otp id
        $otpId = OTP::where([
            ['user_id', '=', $id],
            ['verified', '=', false]
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
        }
        elseif($verified && !$check && $staff_name == 'Managment'){
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
        $this->middleware('guest')->except('logout');
    }

    // use phone number to login
    public function username(){
        return 'phone_number';
    }

    /**
     * Logout redirect
     */
    public function logout(Request $request) {
        auth()->logout();
        return redirect('/login')->with('info-message','You are logged out. Login to continue');
    }

}
