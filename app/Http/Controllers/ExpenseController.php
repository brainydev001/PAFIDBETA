<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Carbon\Carbon;

class ExpenseController extends Controller
{
    // get all expense returns blade view
    public function index()
    {
        $expenses = Expense::orderBy('id', 'asc')->get();

        return view('admin.expenses.index', compact(
            'expenses'
        ));  
    }
    //create expense returns blade view
    public function create()
    {
        $category = Expense::all()->unique('category');
        $subCategory = Expense::all();

        return view('admin.expenses.create', compact(
            'category',
            'subCategory'
        ));
    }

    // stores expense record and returns back with alert message
    public function store(Request $request)
    {
        if($request['s_category'] != 'null' && $request['s_sub_category'] != 'null'){
            $data = [
                'category' => $request['s_category'],
                'sub_category' => $request['s_sub_category'],
                'max_cap' => $request['max_cap'],
                'note' => $request['note'],
                'created_by' => auth()->user()->id,
                'created_by_name' => auth()->user()->first_name.' '.auth()->user()->last_name
            ];
            $expense = Expense::create($data);
        }elseif($request['s_category'] != 'null' && $request['s_sub_category'] == 'null'){
            $data = [
                'category' => $request['s_category'],
                'sub_category' => $request['sub_category'],
                'max_cap' => $request['max_cap'],
                'note' => $request['note'],
                'created_by' => auth()->user()->id,
                'created_by_name' => auth()->user()->first_name.' '.auth()->user()->last_name
            ];
            $expense = Expense::create($data);
        }elseif($request['s_sub_category'] != 'null' && $request['s_category'] == 'null'){
            $data = [
                'category' => $request['category'],
                'sub_category' => $request['s_sub_category'],
                'max_cap' => $request['max_cap'],
                'note' => $request['note'],
                'created_by' => auth()->user()->id,
                'created_by_name' => auth()->user()->first_name.' '.auth()->user()->last_name
            ];
            $expense = Expense::create($data);
        }elseif($request['s_category'] == 'null' && $request['s_sub_category'] == 'null'){
            $data = [
                'category' => $request['category'],
                'sub_category' => $request['sub_category'],
                'max_cap' => $request['max_cap'],
                'note' => $request['note'],
                'created_by' => auth()->user()->id,
                'created_by_name' => auth()->user()->first_name.' '.auth()->user()->last_name
            ];
            $expense = Expense::create($data);
        };
        if($expense->id)
        {
            return redirect()->back()->with('success-message', $expense->note.' Expense created successfully');
        }else{
            return redirect()->back()->with('warning-message', 'Error occured while creating expense. Please try again');
        };
    }

    // update  expense and redirects back
    public function update(Request $request, $id, $type)
    {
       
        $expense = Expense::find($id);
    
        if($expense && $type == 'amend')
        {
            // set expenses d.b data columns
            $time = Carbon::now()->toDateTimeString();
            $userName = auth()->user()->first_name.' '.auth()->user()->last_name;
            // update data array
            $data = [
                'note' => $request['note'],
                'max_cap' => $request['max_cap'],
                'updated_at' => $time,
                'created_by_name' => $userName
            ];

            // update func
            $update = $expense->update($data);

            if ($update) {
                return redirect()->back()->with('success-message', 'Expense amended successfully');
            } else {
                return redirect()->back()->with('error-message', 'Error while amending expense. Please try again.');
            }
        }else{
            return redirect()->back()->with('warning-message', 'Error occured while amending expense. Please try again');
        };
    }

    // approve expense and redirects back
    public function approve($id)
    {
       
        $expense = Expense::find($id);

        if($expense)
        {
            // set expenses d.b data columns
            $now = Carbon::now();
            $userName = auth()->user()->first_name.' '.auth()->user()->last_name;
            $note = $expense->note;
            $data = [
                'updated_at' => $now,
                'note' => $note.' & Approved',
                'created_by_name' => $userName 
            ];

            // approve func
            $update = $expense->update($data);

            if ($update) {
                return redirect()->back()->with('success-message', 'Expense approved successfully');
            } else {
                return redirect()->back()->with('error-message', 'Error while approving expense. Please try again.');
            }
            
        }else{
            return redirect()->back()->with('warning-message', 'Error occured while updating expense. Please try again');
        };
    }

    // delete expense and redirects back
    public function delete($id)
    {
       
        $expense = Expense::find($id)->delete();

        if($expense)
        {
            return redirect()->back()->with('success-message', 'Expense deleted successfully');
        }else{
            return redirect()->back()->with('warning-message', 'Error occured while deleting expense. Please try again');
        };
    }

}
