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
                        <h1 class="m-0 text-dark">Create New Role</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ul class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item ml-1">
                                <a href="{{ 'access_control' }}" class="text-blue">
                                    <u>Create Role</u>
                                </a>
                            </li>
                        </ul>
                        <ul class="breadcrumb float-sm-right ml-1">
                            <li class="breadcrumb-item">
                                <a href="{{ 'access_control' }}" class="text-dark">
                                    Access Control /</a>
                            </li>
                        </ul>
                        <ul class="breadcrumb float-sm-right ml-1">
                            <li class="breadcrumb-item">
                                <a href="{{ url('dashboard_index') }}" class="text-dark">
                                    Dashboard /
                                </a>
                            </li>
                        </ul>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        {{-- create role and attach permissions form --}}
        <div class="container-fluid border shadow-md">

            {{-- form item --}}
            <div class="container-fluid nav-clearfix">

                {{-- form --}}
                <div class="col-md-6 mb-4 card p-2 rounded-0 mt-3 text-center" style="margin:auto;">
                    <form method="POST" action="{{ route('role_create' , ['origin' => 'users and security, create role']) }}">
                        @csrf

                        {{-- include role form --}}
                        @include('admin.access_control.inc.role_crud')

                        {{-- include permission form --}}
                        @include('admin.access_control.inc.permission_crud')
                </div>
                <div class="mt-3 mb-3">
                    <button class="btn btn-success btn-sm auth-btn">Create</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- include alert messages --}}
    @include('alerts.messages')
    </div>
@endsection
