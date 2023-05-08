<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Budget;
use App\Models\Expense;
use App\Models\File;
use App\Models\Requisition;
use App\Models\PDM;
use App\Models\Proof;

/**
 * Controller handles requisitions for Activities and Per Diems.
 * Controller handles approval and reject request.
 * Controller handles amends. 
 * Log information and messaging API.
 */

class RequisitionController extends Controller
{
    //returns requisition blade
    public function index()
    {
        return view('admin.requisition.index');
    }

    // activity requisition
    public function activityRequest($type)
    {
        if ($type == 'Admin') {
            $activities = Activity::orderBy('id', 'asc')->get();
        } elseif ($type == 'RC') {
            $region_id = auth()->user()->region_id;
            $activities = Activity::where([
                ['region_id', '=', $region_id]
            ])->orderBy('id', 'asc')->get();
        }elseif ($type == 'AC') {
            $id = auth()->user()->id;
            $county_name = auth()->user()->county;
            $activities = Activity::where([
                ['county', '=', $county_name]
            ])->orderBy('id', 'asc')->get();
        }

        return view('admin.requisition.list', compact(
            'activities'
        ));
    }

    // per diem requisition
    public function pdmRequest($type)
    {
        if ($type == 'Admin') {
            $activities = Activity::orderBy('id', 'asc')->get();
        }elseif($type == 'RC'){
            $region_id = auth()->user()->region_id;
            $activities = Activity::where([
                ['region_id', '=', $region_id]
            ])->orderBy('id', 'asc')->get();
        }elseif($type == 'AC'){
            $region_id = auth()->user()->region_id;
            $activities = Activity::where([
                ['region_id', '=', $region_id]
            ])->orderBy('id', 'asc')->get();
        }

        return view('admin.requisition.pdm', compact(
            'activities',
        ));
    }

    // proofs create blade
    public function proofIndex()
    {
        return view('admin.payment.proofs.index');
    }

    // proof upload and view
    public function proof($type)
    {
        if ($type == 'uploadrequest') {
            $request = Requisition::where([
                ['user_id', '=', auth()->user()->id],
                ['is_disbursed', '=', true]
            ])->get();
            $pdm = PDM::where([
                ['user_id', '=', auth()->user()->id],
            ])->get();
            $expenses = Expense::all()->unique('category');
            $expensesSub = Expense::all()->unique('sub_category');
            return view('admin.payment.proofs.upload_request', compact(
                'request',
                'expenses',
                'expensesSub',
                'pdm'
            ));
        }elseif($type == 'uploadpdm'){
            $request = Requisition::where([
                ['user_id', '=', auth()->user()->id],
                ['is_disbursed', '=', true]
            ])->get();
            $pdm = PDM::where([
                ['user_id', '=', auth()->user()->id],
                ['is_disbursed', '=', true]
            ])->get();
            $expenses = Expense::all()->unique('category');
            $expensesSub = Expense::all()->unique('sub_category');
            return view('admin.payment.proofs.upload_pdm', compact(
                'request',
                'expenses',
                'expensesSub',
                'pdm'
            ));
        }elseif($type == 'Proof'){
            $datas = Proof::where([
                ['user_id', '=', auth()->user()->id]
            ])->get();

            return view('admin.payment.proofs.list', compact(
                'datas'
            ));
        }
    }

    // proof store
    public function uploadProof(Request $request)
    {
        // requsition or/and pdm variables
        if($request['req_name']){
            $requisition = Requisition::where([
                ['id', '=', $request['req_name']]
            ])->first();
        }elseif($request['pdm_name']){
            $requisition = PDM::where([
                ['id', '=', $request['pdm_name']]
            ])->first();
        }
        $name = $requisition->name;
        $category = $requisition->category;
        $sub_category = $requisition->sub_category;
        $expenseId = Expense::where([
            ['category', '=', $category],
            ['sub_category', '=', $sub_category],
        ])->pluck('id')->first();
        $id = auth()->user()->id;
        $userName = auth()->user()->first_name.' '.auth()->user()->last_name;

        // handling images using sym link method
        $path = $request['file']->store('public/file');
        $file_data = [
            'file_path' => $path,
            'user_id' => $id,
            'file_relation_id' => $id
        ];
        $dbFile = File::create($file_data);
        if (isset($dbFile->id)) {
            $dbFile->update([
                'is_viable' => true,
                'is_stored_locally' => true,
            ]);
        }

        if($request['req_name']){
            $data = [
                'name' => $name,
                'amount' => $request['amount'],
                'details' => $request['note'],
                'category' => $category,
                'sub_category' => $sub_category,
                'report' => $request['report'],
                "payment_date" => $request['payment_date'],
                "requisition_id" => $request['req_name'],
                "expense_id" => $expenseId,
                "user_id" => $id,
                "created_by" => $id,
                "created_by_name" => $userName,
                "file_id" => $dbFile->id,
                "storage_path" => $path
            ];
    
            $dbPDM = Proof::create($data);
        }else{
            $data = [
                'name' => $name,
                'amount' => $request['amount'],
                'details' => $request['note'],
                'category' => $category,
                'sub_category' => $sub_category,
                'report' => $request['report'],
                "payment_date" => $request['payment_date'],
                "pdm_id" => $request['pdm_name'],
                "expense_id" => $expenseId,
                "user_id" => $id,
                "created_by" => $id,
                "created_by_name" => $userName,
                "file_id" => $dbFile->id,
                "storage_path" => $path
            ];
    
            $dbPDM = Proof::create($data);
        }

        if (isset($dbPDM->id)) {
            return redirect()->back()->with('success-message', 'Payment Proof submitted successfully');
        } else {
            return redirect()->back()->with('danger-message', 'Error occured while submitting payment proof. Please try again later.');
        };
    }

    // store pdm
    public function storeRequestPDM(Request $request)
    {
        // per diem variables
        $activity = Activity::where([
            ['id', '=', $request['activity_name']]
        ])->first();
        $name = $activity->name;
        $county = $activity->county;
        $sub_county = $activity->sub_county;
        $region = $activity->regions->name;
        $area = $activity->area_name;
        $start_date = explode('T', $request['start_date'])[0];
        $start_time = explode('T', $request['start_date'])[1];
        $end_date = explode('T', $request['end_date'])[0];
        $end_time = explode('T', $request['end_date'])[1];
        $id = auth()->user()->id;

        // handling images using sym link method
        $path = $request['file']->store('file');
        $file_data = [
            'file_path' => $path,
            'user_id' => $id,
            'file_relation_id' => $id
        ];
        $dbFile = File::create($file_data);
        if (isset($dbFile->id)) {
            $dbFile->update([
                'is_viable' => true,
                'is_stored_locally' => true,
            ]);
        }

        $data = [
            'name' => $name,
            'amount' => $request['amount'],
            'details' => $request['note'],
            'county' => $county,
            'sub_county' => $sub_county,
            'region_name' => $region,
            'area_name' => $area,
            'note' => $request['note'],
            "start_date" => $start_date,
            "start_time" => $start_time,
            "end_date" => $end_date,
            "end_time" => $end_time,
            "user_id" => $id,
            "log_id" => $id,
            "file_id" => $dbFile->id,
        ];

        $dbPDM = PDM::create($data);

        if (isset($dbPDM->id)) {
            return redirect()->back()->with('success-message', 'Per Diem requested successfully');
        } else {
            return redirect()->back()->with('danger-message', 'Error occured while requesting Per Diem. Please try again later.');
        };
    }

    // activity list
    public function list($type)
    {
        if ($type == 'Admin') {
            $user_id = auth()->user()->id;
            $requests = Requisition::orderBy('id', 'desc')->get();
            $totals = Requisition::sum('amount');
        } elseif ($type == 'RC') {
            $region_name = auth()->user()->regions->name;
            $requests = Requisition::where([
                ['region_name', '=', $region_name]
            ])->orderBy('id', 'desc')->get();
            $totals = Requisition::where([
                ['region_name', '=', $region_name]
            ])->sum('amount');
        }elseif ($type == 'AC') {
            $county_name = auth()->user()->county;
            $requests = Requisition::where([
                ['user_id', '=', auth()->user()->id]
            ])->orderBy('id', 'desc')->get();
            $totals = Requisition::where([
                ['county', '=', $county_name]
            ])->sum('amount');
        }

        return view('admin.requisition.activity_request', compact(
            'requests',
            'totals'
        ));
    }

    // per diem list
    public function pdmList($type)
    {
        if ($type == 'Admin') {
            $user_id = auth()->user()->id;
            $pdms = PDM::orderBy('id', 'desc')->get();
            $totals = PDM::sum('amount');
        }elseif($type == 'RC'){
            $region_name = auth()->user()->regions->name;
            $pdms = PDM::where([
                ['region_name', '=', $region_name]
            ])->orderBy('id', 'desc')->get();
            $totals = PDM::where([
                ['region_name', '=', $region_name]
            ])->sum('amount');
        }elseif($type == 'AC'){
            $county_name = auth()->user()->county;
            $pdms = PDM::where([
                ['county', '=', $county_name],
                ['user_id', '=', auth()->user()->id]
            ])->orderBy('id', 'desc')->get();
            $totals = PDM::where([
                ['county', '=', $county_name]
            ])->sum('amount');
        }
        return view('admin.requisition.pdm_list', compact(
            'pdms',
            'totals'
        ));
    }

    public function makeRequest($type, $id)
    {
        if ($type == 'Admin') {
            $activity = Activity::find($id);
            $category = Expense::all()->unique('category');

            // data organization of sub categories in groups
            $subCategory = Expense::all();
            
            return view('admin.requisition.request', compact(
                'activity',
                'type',
                'id',
                'category',
                'subCategory'
            ));
        }
    }

    // store requisition 
    public function storeRequest(Request $request, $type, $id)
    {
        $activity = Activity::find($id);
        $county = $activity->county;
        $sub_county = $activity->sub_county;
        $region = $activity->regions->name;
        $area = $activity->area_name;
        $first_name = auth()->user()->first_name;
        $last_name = auth()->user()->last_name;

        $dbAct = Requisition::create([
            'name' => $request['name'],
            'type' => 'Activity',
            'details' => $request['note'],
            'amount' => $request['amount'],
            'category' => $request['category'],
            'sub_category' => $request['sub_category'],
            'user_id' => auth()->user()->id,
            'county' => $county,
            'sub_county' => $sub_county,
            'region_name' => $region,
            'area_name' => $area,
            'note' => $request['note'],
            'activity_id' => $id,
            'created_by_name' => $first_name . ' ' . $last_name,
            'log_id' => null
        ]);

        // update to recent activity requisition 
        $act = Activity::find($id);
        $act->update([
            'requisition_id' => $dbAct->id
        ]);

        if ($dbAct) {
            return redirect()->back()->with('success-message', 'Requisition made successfully. Go back to main menu or make another requisition');
        } else {
            return redirect()->back()->with('danger-message', 'Error while creating requisition. Please try again');
        };
    }

    // approve & reject requests, reports
    public function approval($type, $origin, $id)
    {
        if ($type == 'approve' && $origin == 'admin') {
            // requisition approve admin
            $request = Requisition::find($id);
            $data = [
                'is_examined' => true, 
                'is_approved' => true,
                'managment_id' => auth()->user()->id,
                'is_pending' => false,
                'is_rejected' => false,
                'approved_by_name' => auth()->user()->first_name . ' ' . auth()->user()->last_name,
                'rejected_by_name' => null
            ];
            $request->update($data);

            return redirect()->back()->with('success-message', 'Requisition has been approved successfully');
        }elseif ($type == 'examin' && $origin == 'rac') {
            // requisition examin rac
            $request = Requisition::find($id);

            $request->update([
                'is_examined' => true,
                'rac_id' => auth()->user()->id,
                'is_approved' => false,
                'is_pending' => true,
                'is_rejected' => false,
                'approved_by_name' => null,
                'rejected_by_name' => null,
            ]);
  
            return redirect()->back()->with('info-message', 'Requisition has been recorded as successfully examined. An S.M.S will be sent once it has been approved');
        }elseif ($type == 'reject' && $origin == 'admin') {
            // requisition reject admin
            $request = Requisition::find($id);

            $request->update([
                'is_examined' => true,
                'is_approved' => false,
                'is_pending' => false,
                'is_rejected' => true,
                'approved_by_name' => null,
                'rejected_by_name' => auth()->user()->first_name . ' ' . auth()->user()->last_name,
            ]);
  
            return redirect()->back()->with('success-message', 'Requisition has been rejected successfully');
        } elseif ($type == 'delete' && $origin == 'AC') {
            // delete request ac
            $request = Requisition::find($id);

            $request->delete();

            return redirect()->back()->with('success-message', 'Requisition has been deleted successfully');
        } elseif ($type == 'reject' && $origin == 'pdm') {
            $request = PDM::find($id);

            $request->update([
                'is_examined' => true,
                'is_approved' => false,
                'is_pending' => false,
                'is_rejected' => true,
            ]);

            return redirect()->back()->with('success-message', 'Per Diem has been rejected successfully');
        } elseif ($type == 'approve' && $origin == 'pdm') {
            $request = PDM::find($id);

            $request->update([
                'is_examined' => true,
                'is_approved' => true,
                'is_pending' => false,
                'is_rejected' => false,
            ]);

            return redirect()->back()->with('success-message', 'Per Diem has been approved successfully');
        } elseif ($type == 'disburse' && $origin == 'invoice') {
            $request = Requisition::find($id);

            $request->update([
                'is_examined' => true,
                'is_approved' => true,
                'is_pending' => false,
                'is_rejected' => false,
                'is_disbursed' => true,
                'disbursed_by_name' => auth()->user()->first_name . ' ' . auth()->user()->last_name,
            ]);

            $budget = Budget::create([
                'name' => $request->name,
                'type' => $request->type,
                'amount' => $request->amount,
                'details' => $request->details,
                'category' => $request->category,
                'sub_category' => $request->sub_category,
                'activity_id' => $request->activities->id,
                'requisition_id' => $request->id,
                'created_by' => $request->createdBy->id,
            ]);
            if ($budget->id) {
                return redirect()->back()->with('success-message', 'Requisition disbursed successfully');
            } else {
                return redirect()->back()->with('danger-message', 'Error occured while disbursing the requisition. Please try again');
            };
        } elseif ($type == 'reject' && $origin == 'invoice') {
            $request = Requisition::find($id);

            $request->update([
                'is_examined' => true,
                'is_approved' => false,
                'is_pending' => false,
                'is_rejected' => true,
                'is_disbursed' => false
            ]);

            $budgetDel = Budget::where([
                ['name', '=', $request->name],
                ['type', '=', $request->type],
                ['amount', '=', $request->amount],
                ['requisition_id', '=', $request->id]
            ])->delete();

            return redirect()->back()->with('success-message', 'Requisition has been rejected successfully');
        } elseif ($type == 'confirm' && $origin == 'budget') {
            $request = Budget::find($id);

            $request->update([
                'confirmed_by' => auth()->user()->id,
                'disbursed_by' => auth()->user()->id,
            ]);
            return redirect()->back()->with('success-message', 'Budget payment has been confirmed');
        }
    }

    // amend requests
    public function amend(Request $request, $id)
    {
        $amendReq = Requisition::find($id);

        // update data
        $amendReq->update($request->all());

        return back()->with('success-message', 'Requisition updated successfully');
    }
}
