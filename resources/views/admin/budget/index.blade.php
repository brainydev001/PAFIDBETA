@extends('layouts.admin')

@section('page')
    {{-- include top nav --}}
    @include('admin.inc.admin_top_nav')

    {{-- include side nav --}}
    @include('admin.inc.admin_side_nav')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        {{-- breadcrumbs --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Budget Manager</h1>
                    </div><!-- /.col -->
                    @if (Auth::user()->hasRole('R.C'))
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('rc-dashboard') }}">Back</a></li>
                            </ol>
                        </div>
                    @elseif(Auth::user()->hasRole('A.C'))
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('ac-dashboard') }}">Back</a></li>
                            </ol>
                        </div>
                    @elseif(Auth::user()->hasRole('F.C'))
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('fc-dashboard') }}">Back</a></li>
                            </ol>
                        </div>
                    @else
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('main-manager') }}">Back</a></li>
                            </ol>
                        </div>
                    @endif
                    <!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>


        {{-- include alert messages --}}
        @include('alerts.messages')

        <button class="btn btn-secondary m-2 text-white" type="button" data-toggle="modal" data-target="#requisition">
            <span>
                Make Requisition
            </span>
            <span class="ml-2 text-white">
                <i class="fas fa-plus"></i>
            </span>
        </button>

        {{-- data card --}}
        <div class="card">

            {{-- heading --}}
            <div class="card-header">
                <h3 class="card-title">Data-table</h3>
            </div>

            {{-- body --}}
            <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Budgeted amount</th>
                            <th>Actual Amount</th>
                            <th>Note</th>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($budgets) > 0)
                            @foreach ($budgets as $budget)
                                <tr>
                                    <td>{{ $budget->requsition_note }}</td>
                                    <td>{{ $budget->estimated_budget }}</td>
                                    <td id="amount">{{ $budget->amount }}</td>
                                    <td>{{ $budget->examination_note }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('budget_remove', [$id, $type]) }}">
                                            <div class="btn btn-danger">
                                                Remove
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->

            <div class="text-right text-bold p-4">
                Amount: {{ $amount }}
            </div>
        </div>
    </div>

    {{-- include modals --}}
    @include('admin.budget.inc.requisition')
@endsection

@section('admin.js')
    {{-- datatable js --}}
    @include('admin.budget.inc.datatable_scripts')
@endsection
