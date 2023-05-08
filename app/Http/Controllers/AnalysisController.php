<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use App\Models\Region;
use App\Models\Role;
use App\Models\User;
use Yajra\DataTables\DataTables;
use App\DataTables\UsersDataTable;
use App\Models\Activity;
use App\Models\Budget;
use App\Models\Expense;
use App\Models\PDM;
use App\Models\Requisition;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class AnalysisController extends Controller
{
    // returns users filter blade based on user type 
    public function users($type)
    {
        if ($type == 'Users') {
            $counties = User::all()->unique('county');
            $sub_counties = User::all()->unique('sub_county');;
            $regions = User::all()->unique('region_id');
            $roles = User::all()->unique('role');
            $dTypes = Farmer::all()->unique('disability');

            // data for graphs and charts
            $data = User::select('id', 'created_at')->get()->groupBy(function($data){
                return Carbon::parse($data->created_at)->format('M');
            });
            $months = [];
            $monthsCount = [];
            foreach ($data as $month => $value) {
                $months[] = $month;
                $monthsCount[] = count($value);

            };
            $blade = 'admin.analytics.users';
        } else {
            $counties = Farmer::all()->unique('county');
            $sub_counties = Farmer::all()->unique('sub_county');;
            $regions = Farmer::all()->unique('region_id');
            $roles = User::all()->unique('role');
            $dTypes = Farmer::all()->unique('disability');

            // data for graphs and charts
            $data = Farmer::select('id', 'created_at')->get()->groupBy(function($data){
                Carbon::parse($data->created_at)->format('M');
            });
            $months = [];
            $monthsCount = [];
            foreach ($data as $month => $value) {
                $months[] = $month;
                $monthsCount[] = count($value);

            };
            $blade = 'admin.analytics.farmer';
        }

        return view($blade, compact(
            'counties',
            'sub_counties',
            'regions',
            'roles',
            'dTypes',
            'type',
            'months',
            'monthsCount'
        ),
        // graph by chart.js variables and objects
        [
            'data' => $data,
            'months' => $months,
            'monthsCount' => $monthsCount
        ]);
    }

    // returns expense filter blade
    public function expense()
    {
        // set variables to compact through
        $categories = Expense::all()->unique('category');
        $subCategories = Expense::all()->unique('sub_category');

        // return to
        return view('admin.analytics.expense', compact(
            'categories',
            'subCategories'
        ));
    }

    // returns payment filter blade
    public function payment()
    {
        // set variables to compact through
        // invoice
        $Idatas = Requisition::where([
            ['is_approved', '=', true],
            ['is_disbursed', '=', false]
        ])->get();
        $Icounties = $Idatas->unique('county');
        $Isub_counties = $Idatas->unique('sub_county');
        $Iregions = $Idatas->unique('region_name');
        $Icategory = $Idatas->unique('category');
        $Isub_category = $Idatas->unique('sub_category');
        $Itotals = Requisition::where([
            ['is_approved', '=', true]
        ])->sum('amount');

        // budget
        $Bdatas = Budget::where([
            ['disbursed_by', '=', null],
            ['confirmed_by', '=', null]
        ])->orderBy('id', 'desc')->get();
        $Btotals = Budget::where([
            ['disbursed_by', '=', null],
            ['confirmed_by', '=', null]
        ])->sum('amount');
        $Bcounties = array();
        $Bsub_counties = array();
        $Bregions = array();
        if(count($Bdatas) > 0 ){
            foreach($Bdatas as $data){
                $Bcounty = $data->requisitions->county;
                $Bsub_county = $data->requisitions->sub_county;
                $Bregion = $data->requisitions->region_name;
                array_push($Bcounties, $Bcounty);
                array_push($Bsub_counties, $Bsub_county);
                array_push($Bregions, $Bregion);
            }
        }
        $Bcategory = $Bdatas->unique('category');
        $Bsub_category = $Bdatas->unique('sub_category');
        
        // receipt
        $Rdatas = Budget::where([
            ['confirmed_by', '!=', null]
        ])->orderBy('id', 'desc')->get();
        $Rtotals = Budget::where([
            ['confirmed_by', '!=', null]
        ])->sum('amount');
        $Rcounties = array();
        $Rsub_counties = array();
        $Rregions = array();
        if(count($Rdatas) > 0 ){
            foreach($Rdatas as $data){
                $Rcounty = $data->requisitions->county;
                $Rsub_county = $data->requisitions->sub_county;
                $Rregion = $data->requisitions->region_name;
                array_push($Rcounties, $Rcounty);
                array_push($Rsub_counties, $Rsub_county);
                array_push($Rregions, $Rregion);
            }
        }
        $Rcategory = $Rdatas->unique('category');
        $Rsub_category = $Rdatas->unique('sub_category');

        // return to
        return view('admin.analytics.payment', compact(
            'Idatas',
            'Itotals',
            'Icounties',
            'Isub_counties',
            'Iregions',
            'Icategory',
            'Isub_category',

            'Bdatas',
            'Bcounties',
            'Bsub_counties',
            'Bregions',
            'Bcategory',
            'Bsub_category',
            'Btotals',
            
            'Rcounties',
            'Rsub_counties',
            'Rregions',
            'Rcategory',
            'Rsub_category',
            'Rdatas',
            'Rtotals'
        ));
    }

    // returns activity filter blade
    public function activity()
    {
        // set variables to compact through
        $counties = Activity::all()->unique('county');
        $sub_counties = Activity::all()->unique('sub_county');;
        $regions = Activity::all()->unique('region_id');
        $createdBy = Activity::all()->unique('created_by_name');

        // return to activity blade
        return view('admin.analytics.activity', compact(
            'counties',
            'sub_counties',
            'regions',
            'createdBy'
        ));
    }

    // returns requisition filter blade
    public function requisition($type)
    {
        if ($type == 'Request') {
            // set variables to compact through
            $counties = Requisition::all()->unique('county');
            $sub_counties = Requisition::all()->unique('sub_county');;
            $regions = Requisition::all()->unique('region_name');
            $categories = Requisition::all()->unique('category');
            $sub_categories = Requisition::all()->unique('sub_category');
        }else{
            // set variables to compact through
            $counties = PDM::all()->unique('county');
            $sub_counties = PDM::all()->unique('sub_county');
            $regions = PDM::all()->unique('region_name');
            $categories = 0;
            $sub_categories = 0;
        }

        // return to requisition blade
        return view('admin.analytics.requisition', compact(
            'counties',
            'sub_counties',
            'regions',
            'categories',
            'sub_categories',
            'type'
        ));
    }

    /**
     * Public and Private sort and search algorithim using eloquent with normalized data.
     * Private Reusable & Public Non reusable.
     * Pending refactor(MAJOR*).
     * Accuracy 90%.
     * BigO notation NAN calculated.
     */

    // sort staff
    public function filterStaff(Request $request)
    {
        $min_age = $request->input('min_age');
        $max_age = $request->input('max_age');
        $roles = $request->input('roles');
        $counties = $request->input('county');
        $subCounties = $request->input('sub_county');
        $regions = $request->input('region');

        if (!$min_age) {
            $min_age = 0;
        }

        if (!$max_age) {
            $max_age = 100; // hundred
        }

        if ($counties && $subCounties && $regions && $roles) {
            $users = User::whereBetween('age', [$min_age, $max_age])
                ->where(function ($query) use ($counties) {
                    $query->whereIn('county', $counties);
                })
                ->where(function ($query) use ($subCounties) {
                    $query->whereIn('sub_county', $subCounties);
                })
                ->where(function ($query) use ($regions) {
                    $query->whereIn('region_id', $regions);
                })
                ->where(function ($query) use ($roles) {
                    $query->whereIn('role_id', $roles);
                })
                ->get();
        } elseif ($counties) {
            $users = User::whereBetween('age', [$min_age, $max_age])
                ->where(function ($query) use ($counties) {
                    $query->whereIn('county', $counties);
                })
                ->get();
        } elseif ($subCounties) {
            $users = User::whereBetween('age', [$min_age, $max_age])
                ->where(function ($query) use ($subCounties) {
                    $query->whereIn('sub_county', $subCounties);
                })
                ->get();
        } elseif ($regions) {
            $users = User::whereBetween('age', [$min_age, $max_age])
                ->where(function ($query) use ($regions) {
                    $query->whereIn('region_id', $regions);
                })
                ->get();
        } else {
            $users = User::whereBetween('age', [$min_age, $max_age])
                ->get();
        }

        if ($users) {
            return view('admin.analytics.filter.staff_filter', compact(
                'users'
            ));
        } else {
            return back()->with('warning-message', 'Query has an error. Please try again or contact I.T support.');
        }
    }

    // sort farmer
    public function filterFarmer(Request $request)
    {
        // get data inputs and set variables
        $age = $request->input('age');
        $disability_name = $request->input('disability_name');
        $type = $request->input('type');
        $gender = $request->input('gender');
        $counties = $request->input('county');
        $subCounties = $request->input('sub_county');
        $regions = $request->input('region');


        if ($age && $disability_name && $type && $gender && $counties && $subCounties && $regions) {
            $users = Farmer::where([
                ['age', '=', $age]
            ])
                ->where(function ($query) use ($counties) {
                    $query->whereIn('county', $counties);
                })
                ->where(function ($query) use ($subCounties) {
                    $query->whereIn('sub_county', $subCounties);
                })
                ->where(function ($query) use ($regions) {
                    $query->whereIn('region_id', $regions);
                })
                ->where(function ($query) use ($gender) {
                    $query->whereIn('gender', $gender);
                })
                ->where(function ($query) use ($type) {
                    $query->whereIn('type', $type);
                })
                ->where(function ($query) use ($disability_name) {
                    $query->whereIn('disability_name', $disability_name);
                })
                ->get();
        } elseif ($age) {
            $users = Farmer::where([
                ['age', '=', $age]
            ])->get();
        } elseif ($counties) {
            $users = Farmer::where(function ($query) use ($counties) {
                $query->whereIn('county', $counties);
            })->get();
        } elseif ($subCounties) {
            $users = Farmer::where(function ($query) use ($subCounties) {
                $query->whereIn('sub_county', $subCounties);
            })->get();
        } elseif ($regions) {
            $users = Farmer::where(function ($query) use ($regions) {
                $query->whereIn('region_id', $regions);
            })->get();
        } elseif ($gender) {
            $users = Farmer::where(function ($query) use ($gender) {
                $query->whereIn('gender', $gender);
            })->get();
        } elseif ($type) {
            $users = Farmer::where(function ($query) use ($type) {
                $query->whereIn('type', $type);
            })->get();
        } elseif ($disability_name) {
            $users = Farmer::where(function ($query) use ($disability_name) {
                $query->whereIn('disability_name', $disability_name);
            })->get();
        }


        if ($users) {
            return view('admin.analytics.filter.farmer_filter', compact(
                'users'
            ));
        } else {
            return back()->with('warning-message', 'Query has an error. Please try again or contact I.T support.');
        }
    }

    // sort expense
    public function filterExpense(Request $request)
    {
        // get data inputs and set variables
        $min_amount = $request->input('min_amount');
        $max_amount = $request->input('max_amount');
        $categories = $request->input('category');
        $subCategories = $request->input('sub_category');

        // set amount
        if (!$min_amount) {
            $min_amount = 0;
        }

        if (!$max_amount) {
            $max_amount = 1000000000; // billion
        }

        // sort logic using eloquent
        if ($categories && $subCategories) {
            $expenses = Expense::whereBetween('max_cap', [$min_amount, $max_amount])
                ->where(function ($query) use ($categories) {
                    $query->whereIn('category', $categories);
                })
                ->where(function ($query) use ($subCategories) {
                    $query->whereIn('sub_category', $subCategories);
                })
                ->get();
        } elseif ($categories) {
            $expenses = Expense::where(function ($query) use ($categories) {
                $query->whereIn('category', $categories);
            })
                ->get();
        } elseif ($subCategories) {
            $expenses = Expense::where(function ($query) use ($subCategories) {
                $query->whereIn('sub_category', $subCategories);
            })
                ->get();
        } else {
            $expenses = Expense::whereBetween('max_cap', [$min_amount, $max_amount])->get();
        }


        if ($expenses) {
            return view('admin.analytics.filter.expense_filter', compact(
                'expenses'
            ));
        } else {
            return back()->with('warning-message', 'Query has an error. Please try again or contact I.T support.');
        }
    }

    // sort requisition
    public function filterRequisition(Request $request)
    {
        // get data inputs and set variables
        $start_date = Carbon::parse($request['start_date'])->toDateTimeString();
        $end_date = Carbon::parse($request['end_date'])->toDateTimeString();
        $counties = $request->input('county');
        $subcounties = $request->input('sub_county');
        $regions = $request->input('region');
        $categories = $request->input('category');
        $sub_categories = $request->input('sub_category');
        $min_amount = $request->input('min_amount');
        $max_amount = $request->input('max_amount');

        // set amount
        if (!$min_amount) {
            $min_amount = 0;
        }

        if (!$max_amount) {
            $max_amount = 1000000000; // billion
        }

        // sort logic using eloquent
        if ($counties && $subcounties && $regions && $categories && $sub_categories) {
            $requests = Requisition::whereBetween('created_at', [$start_date, $end_date])
                ->whereBetween('amount', [$min_amount, $max_amount])
                ->where(function ($query) use ($counties) {
                    $query->whereIn('county', $counties);
                })
                ->where(function ($query) use ($subcounties) {
                    $query->whereIn('sub_county', $subcounties);
                })
                ->where(function ($query) use ($regions) {
                    $query->whereIn('region_name', $regions);
                })
                ->where(function ($query) use ($categories) {
                    $query->whereIn('category', $categories);
                })
                ->where(function ($query) use ($sub_categories) {
                    $query->whereIn('sub_category', $sub_categories);
                })
                ->get();
        } elseif ($counties) {
            $requests = Requisition::where(function ($query) use ($counties) {
                $query->whereIn('county', $counties);
            })
                ->get();
        } elseif ($subcounties) {
            $requests = Requisition::where(function ($query) use ($subcounties) {
                $query->whereIn('sub_county', $subcounties);
            })
                ->get();
        }  elseif ($regions) {
            $requests = Requisition::where(function ($query) use ($regions) {
                $query->whereIn('region_name', $regions);
            })
            ->get();
        } elseif ($categories) {
            $requests = Requisition::where(function ($query) use ($categories) {
                $query->whereIn('category', $categories);
            })
            ->get();
        }elseif ($sub_categories) {
            $requests = Requisition::where(function ($query) use ($sub_categories) {
                $query->whereIn('sub_category', $sub_categories);
            })
            ->get();
        }else {
            $requests = Requisition::whereBetween('created_at', [$start_date, $end_date])
            ->whereBetween('amount', [$min_amount, $max_amount])
            ->get();
        }


        if ($requests) {
            return view('admin.analytics.filter.requisition_filter', compact(
                'requests'
            ));
        } else {
            return back()->with('warning-message', 'Query has an error. Please try again or contact I.T support.');
        }
    }

    // sort PDM
    public function filterPDM(Request $request)
    {
        // get data inputs and set variables
        $start_date = Carbon::parse($request['start_date'])->toDateTimeString();
        $end_date = Carbon::parse($request['end_date'])->toDateTimeString();
        $counties = $request->input('county');
        $subcounties = $request->input('sub_county');
        $regions = $request->input('region');
        $min_amount = $request->input('min_amount');
        $max_amount = $request->input('max_amount');

        // set amount
        if (!$min_amount) {
            $min_amount = 0;
        }

        if (!$max_amount) {
            $max_amount = 1000000000; // billion
        }

        // sort logic using eloquent
        if ($counties && $subcounties && $regions) {
            $pdms = PDM::whereBetween('created_at', [$start_date, $end_date])
                ->whereBetween('amount', [$min_amount, $max_amount])
                ->where(function ($query) use ($counties) {
                    $query->whereIn('county', $counties);
                })
                ->where(function ($query) use ($subcounties) {
                    $query->whereIn('sub_county', $subcounties);
                })
                ->where(function ($query) use ($regions) {
                    $query->whereIn('region_name', $regions);
                })
                ->get();
        } elseif ($counties) {
            $pdms = PDM::where(function ($query) use ($counties) {
                $query->whereIn('county', $counties);
            })
                ->get();
        } elseif ($subcounties) {
            $pdms = PDM::where(function ($query) use ($subcounties) {
                $query->whereIn('sub_county', $subcounties);
            })
                ->get();
        }  elseif ($regions) {
            $pdms = PDM::where(function ($query) use ($regions) {
                $query->whereIn('region_name', $regions);
            })
            ->get();
        } else {
            $pdms = PDM::whereBetween('created_at', [$start_date, $end_date])
            ->whereBetween('amount', [$min_amount, $max_amount])
            ->get();
        }


        if ($pdms) {
            return view('admin.analytics.filter.pdm_filter', compact(
                'pdms'
            ));
        } else {
            return back()->with('warning-message', 'Query has an error. Please try again or contact I.T support.');
        }
    }

    // sort Activity
    public function filterActivity(Request $request)
    {
        // get data inputs and set variables
        $start_date = Carbon::parse($request['start_date'])->toDateTimeString();
        $end_date = Carbon::parse($request['end_date'])->toDateTimeString();
        $counties = $request->input('county');
        $subcounties = $request->input('sub_county');
        $regions = $request->input('region');
        $createdBy = $request->input('created_by');

        // sort logic using eloquent
        if ($counties && $subcounties && $regions && $createdBy) {
            $activities = Activity::whereBetween('end_date', [$start_date, $end_date])
                ->where(function ($query) use ($counties) {
                    $query->whereIn('county', $counties);
                })
                ->where(function ($query) use ($subcounties) {
                    $query->whereIn('sub_county', $subcounties);
                })
                ->where(function ($query) use ($regions) {
                    $query->whereIn('region_id', $regions);
                })
                ->where(function ($query) use ($createdBy) {
                    $query->whereIn('created_by_name', $createdBy);
                })
                ->get();
        } elseif ($counties) {
            $activities = Activity::where(function ($query) use ($counties) {
                $query->whereIn('county', $counties);
            })
                ->get();
        } elseif ($subcounties) {
            $activities = Activity::where(function ($query) use ($subcounties) {
                $query->whereIn('sub_county', $subcounties);
            })
                ->get();
        }  elseif ($regions) {
            $activities = Activity::where(function ($query) use ($regions) {
                $query->whereIn('region_id', $regions);
            })
            ->get();
        } elseif ($createdBy) {
            $activities = Activity::where(function ($query) use ($createdBy) {
                $query->whereIn('created_by_name', $createdBy);
            })
            ->get();
        }
        else {
            $activities = Activity::whereBetween('end_date', [$start_date, $end_date])->get();
        }


        if ($activities) {
            return view('admin.analytics.filter.activity_filter', compact(
                'activities'
            ));
        } else {
            return back()->with('warning-message', 'Query has an error. Please try again or contact I.T support.');
        }
    }

    // sort payment by type
    /**
     * filter for county, subcounty and region not working
     */
    public function filterPayment(Request $request, $type)
    {
        // get data inputs and set variables
        $min_amount = $request->input('min_amount');
        $max_amount = $request->input('max_amount');
        $counties = $request->input('county');
        $subCounties = $request->input('sub_county');
        $regions = $request->input('region_name');
        $categories = $request->input('category');
        $start_date = Carbon::parse($request['start_date'])->toDateTimeString();
        $end_date = Carbon::parse($request['end_date'])->toDateTimeString();

        // set amount
        if (!$min_amount) {
            $min_amount = 0;
        }

        if (!$max_amount) {
            $max_amount = 1000000000; // billion
        }

        if ($type == 'Invoice') {
            // sort logic using eloquent
            if ($categories && $regions && $subCounties && $counties) {
                $payments = Requisition::where([
                    ['is_approved', '=', true],
                    ['is_disbursed', '=', false]
                ])
                    ->whereBetween('amount', [$min_amount, $max_amount])
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->where(function ($query) use ($counties) {
                        $query->whereIn('county', $counties);
                    })
                    ->where(function ($query) use ($categories) {
                        $query->whereIn('category', $categories);
                    })
                    ->where(function ($query) use ($regions) {
                        $query->whereIn('region_name', $regions);
                    })
                    ->where(function ($query) use ($subCounties) {
                        $query->whereIn('sub_county', $subCounties);
                    })
                    ->get();
            } elseif ($categories) {
                $payments = Requisition::where([
                    ['is_approved', '=', true],
                    ['is_disbursed', '=', false]
                ])
                    ->whereBetween('amount', [$min_amount, $max_amount])
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->where(function ($query) use ($categories) {
                        $query->whereIn('category', $categories);
                    })
                    ->get();
            } elseif ($counties) {
                $payments = Requisition::where([
                    ['is_approved', '=', true],
                    ['is_disbursed', '=', false]
                ])
                    ->whereBetween('amount', [$min_amount, $max_amount])
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->where(function ($query) use ($counties) {
                        $query->whereIn('county', $counties);
                    })
                    ->get();
            } elseif ($subCounties) {
                $payments = Requisition::where([
                    ['is_approved', '=', true],
                    ['is_disbursed', '=', false]
                ])
                    ->whereBetween('amount', [$min_amount, $max_amount])
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->where(function ($query) use ($subCounties) {
                        $query->whereIn('sub_county', $subCounties);
                    })
                    ->get();
            } elseif ($regions) {
                $payments = Requisition::where([
                    ['is_approved', '=', true],
                    ['is_disbursed', '=', false]
                ])
                    ->whereBetween('amount', [$min_amount, $max_amount])
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->where(function ($query) use ($regions) {
                        $query->whereIn('region_name', $regions);
                    })
                    ->get();
            } else {
                $payments = Requisition::where([
                    ['is_approved', '=', true],
                    ['is_disbursed', '=', false]
                ])
                    ->whereBetween('amount', [$min_amount, $max_amount])
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->get();
            }
        }elseif ($type == 'Receipt') {
            // sort logic using eloquent
            if ($categories && $regions && $subCounties && $counties) {
                $payments = Budget::where([
                    ['confirmed_by', '!=', null]
                ])
                    ->whereBetween('amount', [$min_amount, $max_amount])
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->where(function ($query) use ($categories) {
                        $query->whereIn('category', $categories);
                    })
                    ->when(count($counties),function ($query)use ($counties) {
        
                        $query->whereHas('requisitions', function($q) use ($counties) {
                           $q->where( function($q) use ($counties) {
                               foreach ($counties as $county) {
                                 $q->orWhere('county', 'like', '%' . $county . '%');
                              }
                           });
                       });
                    })
                    ->when(count($subCounties),function ($query)use ($subCounties) {
        
                        $query->whereHas('requisitions', function($q) use ($subCounties) {
                           $q->where( function($q) use ($subCounties) {
                               foreach ($subCounties as $sub_county) {
                                 $q->orWhere('sub_county', 'like', '%' . $sub_county . '%');
                              }
                           });
                       });
                    })
                    ->when(count($regions),function ($query)use ($regions) {
        
                        $query->whereHas('requisitions', function($q) use ($regions) {
                           $q->where( function($q) use ($regions) {
                               foreach ($regions as $region_name) {
                                 $q->orWhere('region_name', 'like', '%' . $region_name . '%');
                              }
                           });
                       });
                    })
                    ->get();
            } elseif ($categories) {

                $payments = Budget::where([
                    ['confirmed_by', '!=', null]
                ])
                    ->whereBetween('amount', [$min_amount, $max_amount])
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->where(function ($query) use ($categories) {
                        $query->whereIn('category', $categories);
                    })
                    ->get();
            } elseif ($counties) {
                foreach ($counties as $key => $county) {
                    $test[] = ['county', 'like', '%' . $county . '%'];
                }
                $payments = Budget::where([
                    ['confirmed_by', '!=', null]
                ])
                    ->whereBetween('amount', [$min_amount, $max_amount])
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->when(count($counties),function ($query)use ($counties) {
        
                        $query->whereHas('requisitions', function($q) use ($counties) {
                           $q->where( function($q) use ($counties) {
                               foreach ($counties as $county) {
                                 $q->orWhere('county', 'like', '%' . $county . '%');
                              }
                           });
                       });
                    })
                    ->get();


            } elseif ($subCounties) {
                $payments = Budget::wherewhere([
                    ['confirmed_by', '!=', null]
                ])
                    ->whereBetween('amount', [$min_amount, $max_amount])
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->when(count($subCounties),function ($query)use ($subCounties) {
        
                        $query->whereHas('requisitions', function($q) use ($subCounties) {
                           $q->where( function($q) use ($subCounties) {
                               foreach ($subCounties as $sub_county) {
                                 $q->orWhere('sub_county', 'like', '%' . $sub_county . '%');
                              }
                           });
                       });
                    })
                    ->get();
            } elseif ($regions) {
                $payments = Budget::where([
                    ['confirmed_by', '!=', null]
                ])
                    ->whereBetween('amount', [$min_amount, $max_amount])
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->when(count($regions),function ($query)use ($regions) {
        
                        $query->whereHas('requisitions', function($q) use ($regions) {
                           $q->where( function($q) use ($regions) {
                               foreach ($regions as $region_name) {
                                 $q->orWhere('region_name', 'like', '%' . $region_name . '%');
                              }
                           });
                       });
                    })
                    ->get();
            } else {
                $payments = Budget::where([
                    ['confirmed_by', '!=', null]
                ])
                    ->whereBetween('amount', [$min_amount, $max_amount])
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->get();
            }
        }elseif($type == 'Budget'){
            // sort logic using eloquent
            if ($categories && $regions && $subCounties && $counties) {
                $payments = Budget::where([
                    ['disbursed_by', '=', null],
                    ['confirmed_by', '=', null]
                ])
                    ->whereBetween('amount', [$min_amount, $max_amount])
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->where(function ($query) use ($categories) {
                        $query->whereIn('category', $categories);
                    })
                    ->when(count($counties),function ($query)use ($counties) {
        
                        $query->whereHas('requisitions', function($q) use ($counties) {
                           $q->where( function($q) use ($counties) {
                               foreach ($counties as $county) {
                                 $q->orWhere('county', 'like', '%' . $county . '%');
                              }
                           });
                       });
                    })
                    ->when(count($subCounties),function ($query)use ($subCounties) {
        
                        $query->whereHas('requisitions', function($q) use ($subCounties) {
                           $q->where( function($q) use ($subCounties) {
                               foreach ($subCounties as $sub_county) {
                                 $q->orWhere('sub_county', 'like', '%' . $sub_county . '%');
                              }
                           });
                       });
                    })
                    ->when(count($regions),function ($query)use ($regions) {
        
                        $query->whereHas('requisitions', function($q) use ($regions) {
                           $q->where( function($q) use ($regions) {
                               foreach ($regions as $region_name) {
                                 $q->orWhere('region_name', 'like', '%' . $region_name . '%');
                              }
                           });
                       });
                    })
                    ->get();
            } elseif ($categories) {
                $payments = Budget::where([
                    ['disbursed_by', '=', null],
                    ['confirmed_by', '=', null]
                ])
                    ->whereBetween('amount', [$min_amount, $max_amount])
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->where(function ($query) use ($categories) {
                        $query->whereIn('category', $categories);
                    })
                    ->get();
            } elseif ($counties) {
                $payments = Budget::where([
                    ['disbursed_by', '=', null],
                    ['confirmed_by', '=', null]
                ])
                ->whereBetween('amount', [$min_amount, $max_amount])
                ->whereBetween('created_at', [$start_date, $end_date])
                ->when(count($counties),function ($query)use ($counties) {
    
                    $query->whereHas('requisitions', function($q) use ($counties) {
                       $q->where( function($q) use ($counties) {
                           foreach ($counties as $county) {
                             $q->orWhere('county', 'like', '%' . $county . '%');
                          }
                       });
                   });
                })
                ->get();
            } elseif ($subCounties) {
                $payments = Budget::where([
                    ['disbursed_by', '=', null],
                    ['confirmed_by', '=', null]
                ])
                    ->whereBetween('amount', [$min_amount, $max_amount])
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->when(count($subCounties),function ($query)use ($subCounties) {
        
                        $query->whereHas('requisitions', function($q) use ($subCounties) {
                           $q->where( function($q) use ($subCounties) {
                               foreach ($subCounties as $sub_county) {
                                 $q->orWhere('sub_county', 'like', '%' . $sub_county . '%');
                              }
                           });
                       });
                    })
                    ->get();
            } elseif ($regions) {
                $payments = Budget::where([
                    ['disbursed_by', '=', null],
                    ['confirmed_by', '=', null]
                ])
                    ->whereBetween('amount', [$min_amount, $max_amount])
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->when(count($regions),function ($query)use ($regions) {
        
                        $query->whereHas('requisitions', function($q) use ($regions) {
                           $q->where( function($q) use ($regions) {
                               foreach ($regions as $region_name) {
                                 $q->orWhere('region_name', 'like', '%' . $region_name . '%');
                              }
                           });
                       });
                    })
                    ->get();
            } else {
                $payments = Budget::where([
                    ['disbursed_by', '=', null],
                    ['confirmed_by', '=', null]
                ])
                    ->whereBetween('amount', [$min_amount, $max_amount])
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->get();
            }
        }


        if ($payments) {
            return view('admin.analytics.filter.payment_filter', compact(
                'payments',
                'type'
            ));
        } else {
            return back()->with('warning-message', 'Query has an error. Please try again or contact I.T support.');
        }
    }
}
