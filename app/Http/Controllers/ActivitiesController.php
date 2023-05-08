<?php

/**
 * Manage all activity data
 * Functions in groups
 * Groups include: Public and Private
 * Functions are also reuasable
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Activity;
use App\Models\Farmer;
use App\Models\Requisition;

class ActivitiesController extends Controller
{
    // public functions

    public function index($type)
    {
        if($type == 'Admin'){
            $datas = Activity::orderBy('id', 'asc')->get();
        }elseif($type == 'RC'){
            $region_id = auth()->user()->region_id;
            $datas = Activity::where([
                ['region_id', '=', $region_id]
            ])->orderBy('id', 'asc')->get();
        }elseif($type == 'AC'){
            $county = auth()->user()->county;
            $datas = Activity::where([
                ['county', '=', $county]
            ])->orderBy('id', 'asc')->get();
        }
        
        return view('admin.activities.index', compact(
            'datas'
        ));
    }

    public function create()
    {
        $regions = Region::orderBy('id', 'asc')->get();
        return view('admin.activities.crud_activity', compact(
            'regions'
        ));
    }

    public function store(Request $request)
    {
        // create activity record
        if ($request->all()) {
            $start_date = explode('T', $request['start_date'])[0];
            $start_time = explode('T', $request['start_date'])[1];
            $end_date = explode('T', $request['end_date'])[0];
            $end_time = explode('T', $request['end_date'])[1];
            $first_name = auth()->user()->first_name;
            $last_name = auth()->user()->last_name;
            $data = [
                "name" => $request['name'],
                "details" => $request['description'],
                "type" => 'Activity',
                "start_date" => $start_date,
                "start_time" => $start_time,
                "end_date" => $end_date,
                "end_time" => $end_time,
                "county" =>  $request['county'],
                "sub_county" => $request['sub_county'],
                "region_id" => $request['region_id'],
                "area_name" => $request['area_name'],
                'created_by' => auth()->user()->id,
                "created_by_name" => $first_name . ' ' . $last_name,
            ];
            // store activity
            $activity = Activity::create($data);

            if ($activity) {
                return redirect()->back()->with('success-message', 'Activity Created Successfully. Create another activity');
            } else {
                return redirect()->back()->with('error-message', 'Error !! Occured While Creating Activity. Please try again');
            }
        }else{
            return redirect()->back()->with('error-message', 'Error !! Occured While Creating Activity. Please try again');
        }
    }

    public function show($id)
    {
        $activity = Activity::find($id);

        $requisitions = Requisition::where([
            ['type', '=', 'Activity'],
            ['activity_id', '=', $activity->id]
        ])->get();

        $farmer = Farmer::where([
            ['ward_name', '=', $activity->area_name]
        ])->get(); 

        $farmers = [];

        if($farmer){
            foreach($farmer as $d){
                $f = $d->attendance()->where('activity_id', $id)->get();
                array_push($farmers, $f);
            }
        }
        // dd($farmers);
        return view('admin.activities.single_activity', compact(
            'activity',
            'requisitions',
            'farmers'
        ));
    }
}
