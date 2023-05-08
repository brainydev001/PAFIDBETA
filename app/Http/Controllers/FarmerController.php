<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Attendance;
use App\Models\Farmer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FarmerController extends Controller
{
    //return blade with activities 
    public function index($type)
    {
        if($type == 'FC'){
            $activities = Activity::where([
                ['area_name', '=', auth()->user()->ward_name ]
            ])->get();
        } 
        
        return view('admin.farmer.analysis.filter.area', compact(
            'activities',
            'type'
        ));
    }

    //return blade with farmers 
    public function show($type, $id)
    {
        if($type == 'FC'){
            $activity = Activity::find($id);

            $farmers = Farmer::where([
                ['ward_name', '=', $activity->area_name]
            ])->get(); 
        } 

        return view('admin.farmer.analysis.filter.list', compact(
            'activity',
            'farmers',
            'id'
        ));
    }

    //return back with success message 
    public function store(Request $request, $type, $id)
    {
        if($type == 'FC'){
            $request['attendance_type'] = 'Activity';
            $request['activity_id'] = $id;
            $request['confirmed_by'] = auth()->user()->id;
            $request['log_id'] = auth()->user()->id;
            $request['leader_id'] = auth()->user()->id;
            $request['report'] = 'Present';
            $request['file_path'] = auth()->user()->id;
            $request['attendance_date'] = Carbon::now();
            $data = $request->all();
            Attendance::create($data);

            return redirect()->back()->with('success-message', 'Farmer has been marked present');
        }

    
    }
}
