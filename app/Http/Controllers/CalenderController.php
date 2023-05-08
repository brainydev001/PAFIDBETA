<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalenderController extends Controller
{
    //return to blade 
    public function index(Request $request)
    {
        $events = array();
        $activities = Activity::all();

        if($request->ajax()) {
       
            $data = Activity::whereDate('start_date', '>=', $request->start)
                      ->whereDate('end_date',   '<=', $request->end)
                      ->select('name as title', 'start_date as start', 'end_date as end')
                      ->get();
           
            return response()->json($data);
       }
       return view('calender');

        // if(isset($activities)){
        //     foreach ($activities as $activity) {
        //        $events[] = [
        //             'title' => $activity->name,
        //             'start_date' => Carbon::parse($activity->start_date),
        //             'end_date' => Carbon::parse($activity->end_date),
        //        ];
        //     } 
        // }
        // // return $events;
        // return view('calender')->with(['events' => $events]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request)
    {
 
        switch ($request->type) {
           case 'add':
              $event = Event::create([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'update':
              $event = Event::find($request->id)->update([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'delete':
              $event = Event::find($request->id)->delete();
  
              return response()->json($event);
             break;
             
           default:
             # code...
             break;
        }
    }

}
