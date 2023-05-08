<?php

namespace App\Http\Controllers;

use App\Http\Traits\LogTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Staff;
use App\Models\User;
use App\Models\Setup;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Region;
use Carbon\Carbon;
use Spatie\DbDumper\DbDumper;
use Spatie\DbDumper\Databases\MySql;
use Symfony\Component\HttpFoundation\ServerBag;

class SystemBootController extends Controller
{
    use LogTrait;
    // authorization for set up
    public function setup()
    {
        $data = [
            'username' => 'System',
            'phone_number' => '0796458762',
            'password' => 'pafidsystemadmin2023'
        ];
        //check if data exists and if not create system set up authorization data
        $check = Setup::where([
            ['username', '=', 'System']
        ])->first();
        if (!$check) {
            Setup::create($data);
        }else{
            return redirect()->back()->with('warning-message', 'Unauthorized Access');
        }
        // log details
        $origin = 'System Generated';
        $type = 'Boot User Create';
        $cluster_name = 'Users';
        $user_id = 1;
        $details = 'System Generated Boot User';
        $this->log($origin, $type, $cluster_name, $user_id, $details);

        return view('setup_auth');
    }

    // set up user types and system permissions
    public function setupAuth(Request $request)
    {
        // log details
        $dateTime = Carbon::now();
        // additional log information
        $deviceInfo = $_SERVER['HTTP_USER_AGENT'];
        $location = $_SERVER['REMOTE_ADDR'];
        $accessServerPort = $_SERVER['REMOTE_PORT'];


        // check if details match
        $username = $request['username'];
        $password = $request['password'];

        $check = Setup::where([
            ['username', '=', $username],
            ['password', '=', $password]
        ])->first();

        $unique_identifier = Setup::where([
            ['username', '=', $username],
            ['password', '=', $password]
        ])->pluck('phone_number')->first();

        if ($check) {
            $catchMessage = 'Authorization confirmed. PAFID M.I.S system boot accessed by '
                . $unique_identifier . ' on ' . $dateTime . '.Device used is ' . $deviceInfo . ', IP address is ' . $location . ' on server port ' . $accessServerPort;
            // log info
            $origin = 'System Generated';
            $type = 'User Login';
            $cluster_name = 'Users';
            $user_id = 1;
            $details = $catchMessage;
            $this->log($origin, $type, $cluster_name, $user_id, $details);

            $this->setupPerm($catchMessage);
        } else {
            $catchMessage = 'IMPORTANT Unauthorized access for system boot attempt on ' . $dateTime . '.Device used is ' . $deviceInfo . ', IP address is ' . $location . 'on server port ' . $accessServerPort;
            // log info
            // log info
            $origin = 'System Generated';
            $type = 'User Login';
            $cluster_name = 'Users';
            $user_id = 1;
            $details = $catchMessage;
            $this->log($origin, $type, $cluster_name, $user_id, $details);

            return redirect('setup')->with('warning-message', 'Unauthorized access!!. Re-run setup or call 0796458762 for technical assistance');
        }
    }

    // create backup for mysql d.b from Spite\DbDumper\Databases\PostgreSql
    public function mysqlBackup($type)
    {
        // check type
        if ($type == 'public') {
            $action = true;
        }elseif($type == 'private'){
            $action = true;
        }elseif($type == 'selective'){
            $action = true;
        }else{
            $action = false;
        }

        // check if action is true
        if($action){
            return redirect('backup-auth')->with('info-message', 'ATTENTION!! Authorization is required');
        }else{
            return back()->with('warning-message', 'BACKUP PROCESS ERROR!! TRY AGAIN OR CONTACT I.T SUPPORT via +254796458762.');
        };           
    } 

    // backup auth blade
    public function backupAuth()
    {
        return view('admin.backup.index');
    }

    public function createBackup(Request $request, $type)
    {
        // check type in a nested logic
        if ($type == 'public') {
            // test
            // dd($type);
            $databaseName = 'pafid_beta';
            $username = $request->get('username');
            $passcode = $request->get('passcode');

            // set db userName and password if auth is true
            if($username == 'erp_pafid.online' && $passcode == 'pafid_2023'){
                // set mysql pafid_beta db .env values
                    // values should not be stored
                $userName = 'root';
                $password = '';

                // set notification values
                $sysUser = auth()->user()->first_name.' '.auth()->user()->last_name;
                $sysPhone = auth()->user()->phone_number;
                $sysEmail = auth()->user()->email;
                $messageType = 'S.M.S';
                $recipient = '0796458762';
                $time = Carbon::now();
                // formart $time =>  day :month, day, year + time :hour, minute, second.
                $frmtTime = Carbon::createFromFormat('Y-m-d H:i:s', $time)
                                    ->format('d/m/Y H:i:s');
                $messageSubject = 'Backup Notification comleted at '.$frmtTime;
                $messageBody = 'Backup successfully done on '.$frmtTime.' by'.$sysUser.'. Contact this user via '.$sysPhone.' or'.$sysEmail.' Regards.';

                // check role of user and create back up
                if (!auth()->user()->hasRole('Managment') && !auth()->user()->hasRole('System')) {
                    // set notifiables
                    $messageSubject = 'Erroneous Backup Attempt '.$sysUser.' attempted to access a restricted function on '.$frmtTime;
                    $messageBody = 'Erroneous Backup Attempt on '.$frmtTime.' by'.$sysUser.'. Contact this user via '.$sysPhone.' or'.$sysEmail.' Regards.';
                    
                    // redirect function: redirect back => erroneous role attempt
                    return back()->with('warning-message', $messageSubject.' .BACKUP PROCESS ERROR!!... TRY AGAIN OR CONTACT TECH SUPPORT via +254796458762.');

                } else {
                    // action true => create a dump of a MySql db.
                    $action = true;
                    \Spatie\DbDumper\Databases\MySql::create()
                    ->setDbName($databaseName)
                    ->setUserName($userName)
                    ->setPassword($password)
                    ->dumpToFile('dump.sql');
                }
                

            }else{
                return back()->with('warning-message', '#ERROR. Incorrect Passcode or Username !! TRY AGAIN OR CONTACT I.T SUPPORT via +254796458762.');
            };
        }elseif($type == 'private'){
            $action = true;
        }elseif($type == 'selective'){
            $action = true;
        }else{
            $action = false;
        }
    }

    /**
     * Private functions
     */
    //Setup system permissions and returns permisions & response
    private function setupPerm($response)
    {
        /**
         * PERMISSIONS SETUP
         * -------------------
         * Permission are in groups in desc order based on eco-system allowable teams.
         * Permission are set on system boot.
         * Permissions are grouped into objects which include fac,ac,rac,staff,root.
         */

        $groupPerms = [
            // Permission to users
            ['name' => 'create user', 'display_name' => 'User', 'description' => 'is able to create users'],
            ['name' => 'approve user', 'display_name' => 'User', 'description' => 'is able to approve users'],
            ['name' => 'delete/edit user', 'display_name' => 'User', 'description' => 'is able to delete/edit users'],
            // Permission to activities
            ['name' => 'approve activity', 'display_name' => 'Activity', 'description' => 'is able to approve activities'],
            ['name' => 'create activity', 'display_name' => 'Activity', 'description' => 'is able to create activities'],
            ['name' => 'delete/edit activity', 'display_name' => 'Activity', 'description' => 'is able to delete/edit activities'],
            // Permission to farmers
            ['name' => 'approve farmer', 'display_name' => 'Farmer', 'description' => 'is able to approve farmers'],
            ['name' => 'create farmer', 'display_name' => 'Farmer', 'description' => 'is able to create farmers'],
            ['name' => 'delete/edit farmer', 'display_name' => 'Farmer', 'description' => 'is able to delete/edit farmers'],
            // Permission to Access Control
            ['name' => 'approve access control', 'display_name' => 'Access Control', 'description' => 'is able to approve access control'],
            ['name' => 'create role', 'display_name' => 'Role', 'description' => 'is able to create role'],
            ['name' => 'delete/edit role', 'display_name' => 'Role', 'description' => 'is able to delete/edit role'],
            // Permission to requisition
            ['name' => 'make requisition', 'display_name' => 'Requisition', 'description' => 'is able to make requisitions'],
            ['name' => 'approve requisition', 'display_name' => 'Requisition', 'description' => 'is able to approve requisitions'],
            ['name' => 'amend requisition', 'display_name' => 'Requisition', 'description' => 'is able to amend requisitions'],
            ['name' => 'reject requisition', 'display_name' => 'Requisition', 'description' => 'is able to reject requisitions'],
            // Permission to proofs
            ['name' => 'make proof', 'display_name' => 'Proof', 'description' => 'is able to make proofs'],
            ['name' => 'approve proof', 'display_name' => 'Proof', 'description' => 'is able to approve proofs'],
            ['name' => 'amend proof', 'display_name' => 'Proof', 'description' => 'is able to amend proofs'],
            ['name' => 'reject proof', 'display_name' => 'Proof', 'description' => 'is able to reject proofs'],
            // Permission to Per Diem(PDM)
            ['name' => 'make per diem', 'display_name' => 'Per Diem', 'description' => 'is able to make per diems'],
            ['name' => 'approve per diem', 'display_name' => 'Per Diem', 'description' => 'is able to approve per diems'],
            ['name' => 'amend per diem', 'display_name' => 'Per Diem', 'description' => 'is able to amend per diems'],
            ['name' => 'reject per diem', 'display_name' => 'Per Diem', 'description' => 'is able to reject per diems'],
            // Permisson to Reports
            ['name' => 'access all reports', 'display_name' => 'Report', 'description' => 'is able to access all reports'],
            ['name' => 'access invoice report', 'display_name' => 'Report', 'description' => 'is able to access invoice reports'],
            ['name' => 'access receipt report', 'display_name' => 'Report', 'description' => 'is able to access receipt reports'],
            ['name' => 'access per diem report', 'display_name' => 'Report', 'description' => 'is able to access per diem reports'],
            ['name' => 'access activity report', 'display_name' => 'Report', 'description' => 'is able to access activity reports'],
            ['name' => 'access farmer report', 'display_name' => 'Report', 'description' => 'is able to access farmer reports'],
            ['name' => 'access proof report', 'display_name' => 'Report', 'description' => 'is able to access proof reports'],
            ['name' => 'access requisition report', 'display_name' => 'Report', 'description' => 'is able to access requisition reports'],
            // Permisions to Calender
            ['name' => 'access calender', 'display_name' => 'Calender', 'description' => 'is able access calender'],
            // Permisions to Messaging
            ['name' => 'access messenger', 'display_name' => 'Messenger', 'description' => 'is able access sms messenger'],
            // Permissions to Accounts
            ['name' => 'F.C', 'display_name' => 'F.C', 'description' => 'is able access F.A.C account'],
            ['name' => 'A.C', 'display_name' => 'A.C', 'description' => 'is able access A.C account'],
            ['name' => 'R.C', 'display_name' => 'R.C', 'description' => 'is able access R.A.C account'],
            ['name' => 'Staff', 'display_name' => 'staff', 'description' => 'is able access staff account'],
            ['name' => 'Finance', 'display_name' => 'Finance', 'description' => 'is able access Finance account'],
            ['name' => 'Operation', 'display_name' => 'Operation', 'description' => 'is able access Operation account'],
            ['name' => 'Director', 'display_name' => 'Director', 'description' => 'is able access Director account'],
            ['name' => 'B.O.M', 'display_name' => 'B.O.M', 'description' => 'is able access B.O.M account'],
            ['name' => 'C.E.O', 'display_name' => 'C.E.O', 'description' => 'is able access C.E.O account'],
            ['name' => 'Doner', 'display_name' => 'Doner', 'description' => 'is able access Doner account'],
        ];


        if ($groupPerms) {
            // log info
            $origin = 'System Generated';
            $type = 'Create Permissions';
            $cluster_name = 'Permissions';
            $user_id = 1;
            $details = $response;
            $this->log($origin, $type, $cluster_name, $user_id, $details);
            
            return $this->setupRoles($groupPerms, $response);
        } else {
            # code...
            $catchMessage = 'IMPORTANT!!! Permissions setup failed. Re-run setup or call 0796458762 for technical assistance';
            // log info
            $origin = 'System Generated';
            $type = 'Create Permissions';
            $cluster_name = 'Permissions';
            $user_id = 1;
            $details = $catchMessage;
            $this->log($origin, $type, $cluster_name, $user_id, $details);
            
            return redirect('setup')->with('warning-message', '' . $catchMessage);
        }
    }

    //Setup system roles and return roles & response
    private function setupRoles($groupPerms, $response)
    {
        // system roles in asc order
        $groupRoles = [
            // root access
            $rootRole = [
                'name' => 'System',
                'display_name' => 'System',
                'description' => 'unlimited access'
            ],

            // management access 
            $mngmtRole = [
                'name' => 'Managment',
                'display_name' => 'Managment',
                'description' => 'managment and unlimited data access'
            ],

            // staff access 
            $staffRole = [
                'name' => 'Staff',
                'display_name' => 'Staff',
                'description' => 'office and staff clustered data access'
            ],

            // regional access 
            $rcRole = [
                'name' => 'R.C',
                'display_name' => 'Regional Access',
                'description' => 'regional clustered data access'
            ],

            // county access 
            $acRole = [
                'name' => 'A.C',
                'display_name' => 'County Access',
                'description' => 'county clustered data access'
            ],

            // area access 
            $fcRole = [
                'name' => 'F.C',
                'display_name' => 'Area Access',
                'description' => 'area clustered data access'
            ],
        ];

        if ($groupRoles) {
            // log info
            $origin = 'System Generated';
            $type = 'Create Roles';
            $cluster_name = 'Roles';
            $user_id = 1;
            $details = $response;
            $this->log($origin, $type, $cluster_name, $user_id, $details);

            return $this->syncRolePerm($groupRoles, $groupPerms, $response);
        } else {
            $catchMessage = 'IMPORTANT!!! Roles setup failed. Re-run setup or call 0796458762 for technical assistance';
            // log info
            $origin = 'System Generated';
            $type = 'Create Roles';
            $cluster_name = 'Roles';
            $user_id = 1;
            $details = $catchMessage;
            $this->log($origin, $type, $cluster_name, $user_id, $details);
            
            return redirect('setup')->with('warning-message', '' . $catchMessage);
        }
    }

    //Store permissions and roles and sync permissions to respective role. Returns response and catchMessage
    private function syncRolePerm($groupRoles, $groupPerms, $catchMessage)
    {

        // logic to create Roles & Permissions
        if ($groupPerms && $groupRoles) {

            //loop thru group roles array
            foreach ($groupRoles as $sysRole) {
                $check = Role::where([
                    ['name', '=', $sysRole['name']]
                ])->first();

                if (!$check) {
                    Role::create($sysRole);
                } else {
                    $response = 'Roles already exists. Login or call 0796458762 for technical assistance';
                }
            }

            //loop thru group permissions array
            foreach ($groupPerms as $sysPerm) {
                // loop thru a single permission array and insert permissions to permissions table
                $check = Permission::where([
                    ['name', '=', $sysPerm['name']]
                ])->first();

                if (!$check) {
                    $perms = Permission::create($sysPerm);
                } else {
                    $response = 'Permissions already exists. Login or call 0796458762 for technical assistance';
                }
            }

            // sync roles to respective permissions in respect to user account hierachy
            $fac_role = Role::where([
                ['name', '=', 'F.C']
            ])->first();
            $ac_role = Role::where([
                ['name', '=', 'A.C']
            ])->first();
            $rac_role = Role::where([
                ['name', '=', 'R.C']
            ])->first();
            $staff_role = Role::where([
                ['name', '=', 'Staff']
            ])->first();

            $fac_perm = Permission::where([
                ['name', '=', 'F.C']
            ])->first();
            $ac_perm = Permission::where([
                ['name', '=', 'A.C']
            ])->first();
            $rac_perm = Permission::where([
                ['name', '=', 'R.C']
            ])->first();
            $staff_perm = Permission::where([
                ['name', '=', 'Staff']
            ])->first();

            // root 
            $managment_role = Role::where([
                ['name', '=', 'Managment']
            ])->first();
            $system_role = Role::where([
                ['name', '=', 'System']
            ])->first();
            $dbPerms = Permission::all();

            foreach ($dbPerms as $dbPerm) {
                $system_role->attachPermission($dbPerm->id);
                $managment_role->attachPermission($dbPerm->id);
            }
            // attach permissions
            $fac_role->attachPermission($fac_perm->id);
            $ac_role->attachPermission($ac_perm->id);
            $rac_role->attachPermission($rac_perm->id);
            $staff_role->attachPermission($staff_perm->id);
        }
        // log info
        $origin = 'System Generated';
        $type = 'Sync Roles and Permissions';
        $cluster_name = 'Roles and Permissions';
        $user_id = 1;
        $details = $catchMessage;
        $this->log($origin, $type, $cluster_name, $user_id, $details);

        return $this->rootUser($catchMessage);
    }

    // root user
    private function rootUser($catchMessage)
    {
        // create staff record
        $roles = [
            $fac_role = Role::where([
                ['name', '=', 'F.C']
            ])->first(),
            $ac_role = Role::where([
                ['name', '=', 'A.C']
            ])->first(),
            $rac_role = Role::where([
                ['name', '=', 'R.C']
            ])->first(),
            $staff_role = Role::where([
                ['name', '=', 'Staff']
            ])->first(),
            $managment_role = Role::where([
                ['name', '=', 'Managment']
            ])->first(),
        ];

        $staff_check = Staff::where([
            ['type', '=', 'Managment']
        ])->first();

        if (!$staff_check) {
            foreach ($roles as $key => $role) {
                # code...
                Staff::create([
                    'type' => $role->display_name,
                    'staff_id' => $key,
                    'role_id' => $role->id,
                    'approved_by' => '0',
                    'approved_by_name' => 'System Boot',
                    'log_id' => '0',
                    'created_by' => '0',
                    'role_name' => $role->name,
                    'staff_name' => $role->name,
                ]);
            }
        }

        $staff_id = Staff::where([
            ['type', '=', 'Managment']
        ])->pluck('id')->first();

        $user_check = User::where([
            ['first_name', '=', 'System']
        ])->first();
        // create user
        if (!$user_check) {
            $admin_user = [
                'first_name' => 'System',
                'last_name' => 'Administrator',
                'phone_number' => '07123456789',
                'email' => 'admin@pafidkenya.org',
                'age' => '0',
                'gender' => 'System',
                'staff_id' => $staff_id,
                'role_id' => $managment_role->id,
                'file_id' => '0',
                'password' => Hash::make('pafidsysadmin001'),
                'is_approved' => true
            ];
            $sys_user = User::create($admin_user);

            $sys_user->attachRole($managment_role->id);
        }
        // set regions data
        $regions = [
            ['name' => 'BUSIBUKA (WESTERN)', 'type' => 'Area', 'created_by' => $sys_user->id, 'log_id' => '1', 'on_boot' => true],
            ['name' => 'KIHOMI (NYANZA)', 'type' => 'Area', 'created_by' => $sys_user->id, 'log_id' => '1', 'on_boot' => true],
            ['name' => 'CENTRAL-RIFT', 'type' => 'Area', 'created_by' => $sys_user->id, 'log_id' => '1', 'on_boot' => true],
            ['name' => 'METHA (EASTERN)', 'type' => 'Area', 'created_by' => $sys_user->id, 'log_id' => '1', 'on_boot' => true],
        ];

        foreach ($regions as $region) {
            Region::create($region);
        }
        // log info
        $origin = 'System Generated';
        $type = 'Setup';
        $cluster_name = 'Boot';
        $user_id = 1;
        $details = 'System boot user, regions, roles, permissions and staff types created';
        $this->log($origin, $type, $cluster_name, $user_id, $details);

        return redirect('login');
    }

}
