<?php

namespace App\Http\Controllers;

use App\Http\Traits\LogTrait;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use AfricasTalking\SDK\AfricasTalking;
use Yajra\DataTables\DataTables;
use App\Models\Farmer;
use App\Models\User;
use App\Models\OTP;
use App\Models\Role;
use App\Models\Avatar;
use App\Models\Budget;
use App\Models\Staff;
use App\Models\Region;
use App\Models\Requisition;
use Carbon\Carbon;

class UserManagmentController extends Controller
{
    use LogTrait;

    // otp validate and redirect to route based on staff type
    public function otpValidate($id)
    {
        return view('auth.otp_validation', compact(
            'id'
        ));
    }

    public function authenticate(Request $request, $id)
    {
        $otp = $request['otp'];

        $dbCheck = OTP::where([
            ['id', '=', $id]
        ])->pluck('otp')->first();

        if ($dbCheck == $otp) {
            $dbOtp = OTP::find($id);
            $dbOtp->update([
                'verified' => true,
                'notified' => true
            ]);
            // log details
            $origin = 'System Generated';
            $type = 'OTP Authenticate';
            $cluster_name = 'OTP';
            $user_id = auth()->user()->id;
            $details = 'OTP Verified and Updated';
            $this->log($origin, $type, $cluster_name, $user_id, $details);

            return $this->authRedirect();
        } else {
            // log details
            $origin = 'System Generated';
            $type = 'OTP Authenticate';
            $cluster_name = 'OTP';
            $user_id = auth()->user()->id;
            $details = 'OTP Verification and Update failed';
            $this->log($origin, $type, $cluster_name, $user_id, $details);

            return redirect()->back()->with('error-message', 'OTP expired or does not match');
        }
    }

    // private function to redirect user based on role
    private function authRedirect()
    {
        // user id 
        $user_id = auth()->user()->id;
        // get user type id
        $user_role = auth()->user()->role_id;

        // using the id check on the types table
        $role = Role::find($user_role);
        $role_name = $role->name;

        $verified = User::where(
            [
                ['id', '=', $user_id],
                ['is_approved', '=', false]
            ]
        )->latest()->first();

        // compare the major roles and redirect accordingly
        if (!$verified && $role_name == 'Managment') { 
            // log details
            $origin = 'System Generated';
            $type = 'Login Access';
            $cluster_name = 'Login';
            $user_id = auth()->user()->id;
            $details = 'Access Granted';
            $this->log($origin, $type, $cluster_name, $user_id, $details);
            // compare the major roles and redirect accordingly
            return redirect('main-manager');
        } elseif (!$verified && $role_name == 'Staff') {

            // log details
            $origin = 'System Generated';
            $type = 'Login Access';
            $cluster_name = 'Login';
            $user_id = auth()->user()->id;
            $details = 'Access Granted';
            $this->log($origin, $type, $cluster_name, $user_id, $details);

            return redirect('main-manager');
        } elseif (!$verified && $role_name == 'R.C') {

            // log details
            $origin = 'System Generated';
            $type = 'Login Access';
            $cluster_name = 'Login';
            $user_id = auth()->user()->id;
            $details = 'Access Granted';
            $this->log($origin, $type, $cluster_name, $user_id, $details);

            return redirect('rc-dashboard');
        } elseif (!$verified && $role_name == 'A.C') {
            // log details
            $origin = 'System Generated';
            $type = 'Login Access';
            $cluster_name = 'Login';
            $user_id = auth()->user()->id;
            $details = 'Access Granted';
            $this->log($origin, $type, $cluster_name, $user_id, $details);

            return redirect('ac-dashboard');
        } elseif (!$verified && $role_name == 'F.C') {
            // log details
            $origin = 'System Generated';
            $type = 'Login Access';
            $cluster_name = 'Login';
            $user_id = auth()->user()->id;
            $details = 'Access Granted';
            $this->log($origin, $type, $cluster_name, $user_id, $details);

            return redirect('fc-dashboard');
        } else {

            // log details
            $origin = 'System Generated';
            $type = 'Login Access';
            $cluster_name = 'Login';
            $user_id = auth()->user()->id;
            $details = 'Access Denied';
            $this->log($origin, $type, $cluster_name, $user_id, $details);

            return redirect('logout');
        };
    }

    /**
     *  User managment functions
     * 
     * */

    // approve users
    public function approveUser($type, $id)
    {
        if ($type == 'Active') {
            User::find($id)->update([
                'is_approved' => true,
                'approved_by_name' => auth()->user()->first_name . ' ' . auth()->user()->last_name,
                'approved_by' => auth()->user()->id
            ]);
            $messageType = 'success-message';
            $message = 'User approved successfully';
            // log details
            $origin = 'Admin';
            $type = 'Approve Access';
            $cluster_name = 'Users';
            $user_id = auth()->user()->id;
            $details = $message;
            $this->log($origin, $type, $cluster_name, $user_id, $details);
        } else {
            User::find($id)->update([
                'is_approved' => false,
                'approved_by_name' => auth()->user()->first_name . ' ' . auth()->user()->last_name,
                'approved_by' => auth()->user()->id
            ]);

            $messageType = 'warning-message';
            $message = 'User Disabled successfully';
        }

        return redirect()->back()->with($messageType, $message);
    }

    // user action 
    public function userActions($type, $id)
    {
        if($type == 'archive')
        {
            User::find($id)->delete();

            return redirect()->to('user-users')->with('success-message', 'User Archived Successfully');
        }elseif($type == 'restore'){

            User::withTrashed()->find($id)->restore();
            return back()->with('success-message', 'Archived User Restored Successfully');
        }elseif($type == 'delete'){
            User::find($id)->forceDelete();

            return redirect()->to('user-users')->with('success-message', 'User Information Permanently Deleted');
        }
    }

    // elevate user
    public function userElevate($type, $id)
    {
        $user = User::find($id);
        $role = $user->roleUser->name;

        // role types 
        $mgmRole = Role::where([
                    ['name', '=', 'Managment']
                ])->pluck('id')->first();
        $staffRole = Role::where([
                    ['name', '=', 'Staff']
                ])->pluck('id')->first();
        $rcRole = Role::where([
                    ['name', '=', 'R.C']
                ])->pluck('id')->first();
        $acRole = Role::where([
                    ['name', '=', 'A.C']
                ])->pluck('id')->first();
        $fcRole = Role::where([
                    ['name', '=', 'F.C']
                ])->pluck('id')->first();

        // staff types
        $mgmStaff = Staff::where([
                    ['type', '=', 'Managment']
                ])->pluck('id')->first();
        $staffStaff = Staff::where([
                    ['type', '=', 'Staff']
                ])->pluck('id')->first();
        $rcStaff = Staff::where([
                    ['type', '=', 'Regional Access']
                ])->pluck('id')->first();
        $acStaff = Staff::where([
                    ['type', '=', 'County Access']
                ])->pluck('id')->first();  
        $fcStaff = Staff::where([
                    ['type', '=', 'Area Access']
                ])->pluck('id')->first();

            // control logic
        if($type == 'up'){
            if($role == 'Managment'){
                return back()->with('success-message', 'User has the highest access level. No more elevation can be performed');
            }elseif($role == 'Staff'){
                $user->update([
                    'role_id' => $mgmRole,
                    'staff_id' => $mgmStaff
                ]);
                $user->detachRole($staffRole);
                $user->attachRole($mgmRole);
                return back()->with('success-message', 'User elevated to Managment access level');
            }elseif($role == 'R.C'){ 
                $user->update([
                    'role_id' => $staffRole,
                    'staff_id' => $staffStaff
                ]);
                $user->detachRole($rcRole);
                $user->attachRole($staffRole);
                return back()->with('success-message', 'User elevated to Staff access level');
            }elseif($role == 'A.C'){
                $user->update([
                    'role_id' => $rcRole,
                    'staff_id' => $rcStaff
                ]);
                $user->detachRole($acRole);
                $user->attachRole($rcRole);
                return back()->with('success-message', 'User elevated to Regional(R.A.C) access level');
            }
            elseif($role == 'F.C'){
                $user->update([
                    'role_id' => $acRole,
                    'staff_id' => $acStaff
                ]);
                $user->detachRole($fcRole);
                $user->attachRole($acRole);
                return back()->with('success-message', 'User elevated to County(A.C) access level');
            }
        }else{
            if($role == 'Managment'){
                $user->update([
                    'role_id' => $staffRole,
                    'staff_id' => $staffStaff
                ]);
                $user->detachRole($mgmRole);
                $user->attachRole($staffRole);
                return back()->with('success-message', 'User demoted to Staff access level');
            }elseif($role == 'Staff'){
                $user->update([
                    'role_id' => $rcRole,
                    'staff_id' => $rcStaff
                ]);
                $user->detachRole($staffRole);
                $user->attachRole($rcRole);
                return back()->with('success-message', 'User demoted to Regional(R.A.C) access level');
            }elseif($role == 'R.C'){
                $user->update([
                    'role_id' => $acRole,
                    'staff_id' => $acStaff
                ]);
                $user->detachRole($rcRole);
                $user->attachRole($acRole);
                return back()->with('success-message', 'User demoted to County(A.C) access level');
            }elseif($role == 'A.C'){
                $user->update([
                    'role_id' => $fcRole,
                    'staff_id' => $fcStaff
                ]);
                $user->detachRole($acRole);
                $user->attachRole($fcRole);
                return back()->with('success-message', 'User demoted to Area(F.C) access level');
            }
            elseif($role == 'F.C'){
                return back()->with('success-message', 'User has the lowest access level. No access level demotion action performed');
            }
        }
    }

    // get all system users
    public function allUsers()
    {
        $users = User::orderBy('id', 'asc')->get();
        $type = 'User';

        return view('admin.users.user_type', compact(
            'users',
            'type'
        ));
    }

    
    // datatables
    public function users(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('id','first_name','email')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('users');
    }

    // show single user details
    public function show($type, $id)
    {

        if ($type == 'User') {
            // find user by id and redirect to single user page
            $user = User::find($id);
            $region_name = $user->regions->name;
            $region_id = $user->regions->id;
            $activities = Activity::where([
                ['created_by', '=', $id]
            ])->get();
            $requisitions = Requisition::where([
                ['user_id', '=', $id]
            ])->get();
            $budgets = Budget::where([
                ['created_by', '=', $id],
                ['disbursed_by', '!=', null]
            ])->get();

            return view('admin.users.single_user', compact(
                'user',
                'type',
                'region_name',
                'activities',
                'requisitions',
                'budgets'
            ));
        } elseif ($type == 'Farmer') {
            // find user by id and redirect to single user page
            $user = Farmer::find($id);
            $region_name = $user->regions->name;
            $region_id = $user->regions->id;
            $activities = Activity::where([
                ['region_id', '=', $region_id]
            ])->get();
            return view('admin.users.single_user', compact(
                'user',
                'type',
                'region_name',
                'activities'
            ));
        };
    }

    // update single user details
    public function update(Request $request, $type, $id)
    {

        if ($type == 'User') {
            // find user by id and redirect to single user page
            $user = User::find($id);
            $data = $request->all();

            // update func
            $user->update($data);
            return back()->with('success-message', 'User details updated successfully');
        } elseif ($type == 'Farmer') {
            // find user by id and redirect to single user page
            $user = Farmer::find($id);
            $data = $request->all();

            // update func
            $user->update($data);
            return back()->with('success-message', 'Farmer details updated successfully');
        };
    }

    // create new user blade based on type
    public function createUser($type)
    {
        $roles = Role::orderBy('id', 'asc')->get();
        $regions = Region::orderBy('id', 'asc')->get();
        $staffs = Staff::orderBy('id', 'asc')->get();

        return view('admin.users.create', compact(
            'type',
            'roles',
            'regions',
            'staffs'
        ));
    }


    // get all farmers
    public function farmer($type)
    {
        if ($type == 'Admin') {
            $users = Farmer::orderBy('id', 'asc')->get();
            $type = 'Farmer';
        } elseif ($type == 'RC') {
            $region_id = auth()->user()->region_id;
            $users = Farmer::where([
                ['region_id', '=', $region_id]
            ])->orderBy('id', 'asc')->get();
            $type = 'Farmer';
        } elseif ($type == 'AC') {
            $county = auth()->user()->county;
            $users = Farmer::where([
                ['county', '=', $county]
            ])->orderBy('id', 'asc')->get();
            $type = 'Farmer';
        } elseif ($type == 'FC') {
            $id = auth()->user()->id;
            $users = Farmer::where([
                ['fc_id', '=', $id]
            ])->orderBy('id', 'asc')->get();
            $type = 'Farmer';
        }

        if (isset($users)) {
            return view('admin.users.user_type', compact(
                'users',
                'type'
            ));
        } else {
            return redirect()->back()->with('warning-message', 'You have not created any Farmer using this MIS platform. 
            This might affect your timeley performance index analysis. ' . auth()->user()->first_name . ' ' . auth()->user()->last_name . ' click on the HELP button or contact Pafid System Support on Telephone Number: +254796458762 from 8:00am to 8:00pm Monday-Friday');
        }
    }

    // store user
    public function storeUser(Request $request, $type)
    {


        if ($type == 'User') {
            // handling images using sym link method
            $path = $request['photo']->store('user');


            // handle creating the age using carbon
            $age = explode('-', $request['age'])[0];
            $today = Carbon::now();
            $year = $today->year;
            $age = (int)$year - (int)$age;

            // user who created user
            $creator = auth()->user()->id;

            $rules = [
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
            ];
            $request->validate($rules);
            // user_data
            $data = [
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'phone_number' => $request['phone_number'],
                'email' => $request['email'],
                'age' => $age,
                'gender' => $request['gender'],
                'county' => $request['county'],
                'sub_county' => $request['sub_county'],
                'region_id' => $request['region_id'],
                'ward_name' => $request['area_name'],
                'photo' => $path,
                'created_by' => $creator,
                'staff_id' => $request['type_id'],
                'role_id' => $request['role_id'],
                'file_id' => $request['type_id'],
                'password' => Hash::make($request['password']),
            ];
        } elseif ($type == 'Farmer') {
            /**
             * validate information
             * Validation for unique phone number in users table PENDING
             */
            $rules = [
                'phone_number' => ['required', 'string', 'max:25', 'unique:farmers'],
            ];

            $request->validate($rules);
            $data = $request->all();
        };

        return $this->createRecord($type, $data);
    }



    // PRIVATE DYNAMIC AND REUSABLE FUNCTIONS

    // create user record
    private function createRecord($modelName, $data)
    {
        if ($modelName == 'User') {

            $check = User::create($data);

            // attach role
            $role = Role::find($data['role_id']);
            $check->attachRole($role);
            $userId = $check->id;
            // randomize a number between 10 -1000
            $digits = 5;
            $randomNumber = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);
            // create user one time password
            $otpdata = [
                'user_id' => $check->id,
                'otp' => $randomNumber,
                'verified' => false,
                'notified' => false
            ];

            // save otp data to otp table
            $otp = OTP::create($otpdata);

            // send otp to user
            $sent_by = auth()->user()->id;
            $numbers = $check->phone_number;
            $message = 'Your O.T.P is ' . $otp->otp . '. Valid for 24 hrs';
            $type = 'SMS';

            // send otp to user

            $this->otp($numbers, $message, $sent_by, $type);

            // create an avatar record to d.b
            $avatar = Avatar::create([
                'user_id' => $userId,
                'file_path' => $data['photo'],
                'relation_id' => null,
                'is_stored_locally' => true
            ]);

            $avatarUpdate = User::find($userId);
            // update file_id to avatar object id
            $avatarUpdate->update([
                'file_id' => $avatar->id
            ]);

            // log details
            $origin = 'Admin';
            $type = 'Create User';
            $cluster_name = 'Users';
            $user_id = auth()->user()->id;
            $details = 'User attached role, OTP sent and avatar created locally';
            $this->log($origin, $type, $cluster_name, $user_id, $details);
        } elseif ($modelName == 'Farmer') {

            // add array to farmer data
            if (isset($data['disability_name']) && isset($data['note'])) {
                $data['note'] = $data['note'];
                $data['is_subscribed'] = true;
                $data['fc_id'] = auth()->user()->id;
            } elseif (isset($data['disability_name']) && !isset($data['note'])) {
                $data['note'] = $data['disability_name'];
                $data['is_subscribed'] = true;
                $data['fc_id'] = auth()->user()->id;
            } elseif (!isset($data['disability_name']) && isset($data['note'])) {
                $data['note'] = $data['note'];
                $data['is_subscribed'] = true;
                $data['fc_id'] = auth()->user()->id;
            } else {
                $data['note'] = $data['type'];
                $data['is_subscribed'] = true;
                $data['fc_id'] = auth()->user()->id;
            }

            $check = Farmer::create($data);
        };

        if ($check) {
            $value = 'Success';
            $body = $modelName . ' Successfully Recorded';
            $this->catchMessages($value, $body, $modelName);
        } else {
            $value = 'Warning';
            $body = 'Operation Failed. Please Try Again';
            $this->catchMessages($value, $body, $modelName);
        }

        return $this->catchMessages($value, $body, $modelName);
    }
    // success, error, info, 404, restricted messages
    private function catchMessages($value, $body, $modelName)
    {
        // message types
        $successType = 'success-message';
        $infoType = 'info-message';
        $warningType = 'warning-message';
        $restrictedType = 'restricted-message';
        $requestType = '404-message';
        $networkType = 'network-message';

        //reusable control instructions
        if ($value == 'Success') {
            $message = "'$successType', '$body'";
        } elseif ($value == 'Info') {
            $message = "'$infoType', '$body'";
        } elseif ($value == 'Warning') {
            $message = "'$warningType', '$body'";
        } elseif ($value == 'Restricted') {
            $message = $restrictedType . ',' . $body;
        } elseif ($value == '404') {
            $message = $requestType . ',' . $body;
        } elseif ($value == 'Network') {
            $message = $networkType . ',' . $body;
        }

        // return value
        if ($modelName == 'User') {
            return redirect('user-users')->with($message);
        } elseif ($modelName == 'Farmer') {
            return redirect()->back()->with('success-message', 'Farmer created successfully. Create another farmer');
        }
    }

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
