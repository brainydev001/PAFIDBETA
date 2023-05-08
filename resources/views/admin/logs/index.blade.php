@extends('layouts.admin')

@section('page')
    {{-- include top nav --}}
    @include('admin.inc.admin_top_nav')

    {{-- include side nav --}}
    @include('admin.inc.admin_side_nav')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        {{-- include alert messages --}}
        @include('alerts.messages')

        {{-- breadcrumbs --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">User Logs Manager</h1>
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
                <div class="col-sm-12">
                    {{-- search by date --}}
                    <button class="btn btn-success m-2 text-white" type="button" data-toggle="modal" data-target="#filter">
                        <span>
                            Filter By Date
                        </span>
                        <span class="ml-2 text-white">
                            <i class="fas fa-search"></i>
                        </span>
                    </button>


                    {{-- modals --}}
                    @include('admin.logs.inc.filter_modal')
                    {{-- datatable --}}
                    @include('admin.logs.inc.datatable')
                </div>
            </div><!-- /.container-fluid -->
        </div>

    </div>
@endsection

{{-- section custom scripts --}}
@section('adminScripts')
    {{-- include datatable scripts --}}
    @include('admin.logs.inc.datatables_script')
@endsection
