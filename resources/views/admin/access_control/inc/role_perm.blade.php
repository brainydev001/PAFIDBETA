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
                        <h1 class="m-0 text-dark">{{ ucfirst($origin) }} list</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right ml-1">
                            <li class="breadcrumb-item"><a href="#" class="text-dark">/ {{ ucfirst($origin) }}</a></li>
                        </ol>
                        <ol class="breadcrumb float-sm-right ml-1">
                            <li class="breadcrumb-item"><a href="{{ url('access_control') }}">/ Security & Access Control</a></li>
                        </ol>
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard_index') }}">Dashboard</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        {{-- include alert messages --}}
        @include('alerts.messages')

        {{-- access control types include --}}
        @include('admin.access_control.inc.datatable')
    </div>
@endsection
