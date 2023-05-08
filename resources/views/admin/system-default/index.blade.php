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
                        <h1 class="m-0 text-dark">{{ $type }} Manager</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard_index">Dashboard</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        {{-- include alert messages --}}
        @include('alerts.messages')

        {{-- action bar --}}
        <button class="btn btn-secondary m-2 text-white" type="button" data-toggle="modal"
            data-target="#createRegion">
            <span>
                Create
            </span>
            <span class="ml-2 text-white">
                <i class="fas fa-plus"></i>
            </span>
        </button>

        {{-- datatable --}}
        @include('admin.regions.inc.datatable')

        {{-- create modal include --}}
        @include('admin.regions.inc.createRegion_modal')
    </div>
@endsection

{{-- section custom scripts --}}
@section('adminScripts')
    {{-- include datatable scripts --}}
    @include('admin.types.inc.datatables_script')
@endsection
