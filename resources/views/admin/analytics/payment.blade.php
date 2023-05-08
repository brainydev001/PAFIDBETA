{{-- blade to handle invoices, receipts and budget views  --}}

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
                        <h1 class="m-0 text-dark">Payment Analytics</h1>
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

        {{-- user datatable --}}
        {{-- data card --}}
        <div class="card">

            <div class="card">

                {{-- heading --}}
                <div class="card-header">
                    Search And Sort Payment Data
                </div>
                {{-- body --}}
                <div class="card-body">

                    {{-- filter budget --}}
                    <button class="btn btn-success m-2 text-dark" type="button" data-toggle="modal"
                        data-target="#filterBudget">
                        <span>
                            Filter Budget Data
                        </span>
                        <span class="ml-2 text-white">
                            <i class="fas fa-bars"></i>
                        </span>
                    </button>

                    {{-- filter receipt --}}
                    <button class="btn btn-primary m-2 text-dark" type="button" data-toggle="modal"
                        data-target="#filterReceipt">
                        <span>
                            Filter Receipt Data
                        </span>
                        <span class="ml-2 text-white">
                            <i class="fas fa-bars"></i>
                        </span>
                    </button>

                    {{-- filter Invoice --}}
                    <button class="btn btn-warning m-2 text-dark" type="button" data-toggle="modal"
                        data-target="#filterInvoice">
                        <span>
                            Filter Invoice Data
                        </span>
                        <span class="ml-2 text-white">
                            <i class="fas fa-bars"></i>
                        </span>
                    </button>
                    {{-- Invoice modal --}}
                    @include('admin.analytics.inc.payment_modal')

                </div>
                <!-- /.card-body -->
            </div>
        </div>
    @endsection

    {{-- section custom scripts --}}
    @section('adminScripts')
        {{-- include datatable scripts --}}
        @include('admin.analytics.inc.datatables_script')
    @endsection
