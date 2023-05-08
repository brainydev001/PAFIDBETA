<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Requisition;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // get approved requisitions and return blade view
    public function index($type)
    {
        if($type == 'Invoices') 
        {
            $datas = Requisition::where([
                ['is_approved', '=', true],
                ['is_disbursed', '=', false]
            ])->get();
            $totals = Requisition::where([
                ['is_approved', '=', true],
                ['is_disbursed', '=', false]
            ])->sum('amount');
        }elseif($type == 'Budget'){
            $datas = Budget::where([
                ['disbursed_by', '=', null],
                ['confirmed_by', '=', null]
            ])->orderBy('id', 'desc')->get();
            $totals = Budget::where([
                ['disbursed_by', '=', null],
                ['confirmed_by', '=', null]
            ])->sum('amount');
        }elseif($type == 'Reciepts'){
            $datas = Budget::where([
                ['confirmed_by', '!=', null]
            ])->orderBy('id', 'desc')->get();
            $totals = Budget::where([
                ['confirmed_by', '!=', null]
            ])->sum('amount');
        }

        return view('admin.payment.index', compact(
            'datas',
            'type', 
            'totals'
        ));
    }
}
