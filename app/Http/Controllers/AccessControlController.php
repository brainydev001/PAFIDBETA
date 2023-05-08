<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Permission;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AccessControlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.access_control.index');
    }

    // get all roles or permissions from respective data tables
    public function lists($type)
    {
        $origin = $type;

        if($type == 'roles'){
            $types = Role::all();
        }else{
            $types = Permission::all();
        }

        return view('admin.access_control.type_list', compact(
            'origin',
            'types'
        ));
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /**
         * Redirect to blade for role creation in roles table
         * Compact in all system permissions in groups
         */
        // permissions in groups variables list

        // Region
        $perm_regions = Permission::where([
            ['display_name', '=', 'Region']
        ])->orderBy('id', 'desc')->get();

        // User
        $perm_users = Permission::where([
            ['display_name', '=', 'User']
        ])->orderBy('id', 'desc')->get();

        // Access Control
        $perm_accessControls = Permission::where([
            ['display_name', '=', 'Access Control']
        ])->orderBy('id', 'desc')->get();

        // Role
        $perm_roles = Permission::where([
            ['display_name', '=', 'Role']
        ])->orderBy('id', 'desc')->get();




        return view('admin.access_control.create', compact(
            'perm_regions',
            'perm_users',
            'perm_accessControls',
            'perm_roles'

        ))->with('info-message', 'You are about to create a new role.
                To do so, fill in the input form and check the permissions assigned to the created role. 
                The UNMARKED checkboxes contain system permission.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request, $origin)
    {
        // validate request
        $this->validator($request);

        // get user log
        $created_by = $request['created_by'];

        // redirect to log private function with origin data
        $this->logs($origin, $created_by);

        // declare permission variable
        $permissions = $request['perm'];

        // declare data variable with relevant inputs
        $data = [
            'name' => $request['name'],
            'display_name' => $request['display_name'],
            'description' => $request['description'],
        ];

        // create role
        $role = Role::create($data);

        // sync permissions to created role
        foreach($permissions as $permission)
        {
            $id = $permission;
            $perm_row = Permission::find($id);
            $role = Role::find($role->id);

            // attach permission to role
            $role->attachPermission($perm_row);
        }

        return redirect('access_control')->with('success-message', 'Role created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // reusable private functions
    // user logs
    private function logs($origin, $created_by)
    {
        // get current time
        $mytime = Carbon::now();
        $time =$mytime->toDateTimeString();
        
        // save log data to logs table
        $data = [
            'origin' => $created_by.' accessed '.$origin.' at '.$time,
            'user_id' => auth()->user()->id
        ];
        
        // create new entry in logs table
        // Log::create($data);
    }

    // validation
    private function validator($request)
    {
        $rules = [
            'name' => ['required', 'unique:roles'],
            'display_name' => 'required',
            'description' => 'required'
            
        ];

        return $request->validate($rules);
    }
}
