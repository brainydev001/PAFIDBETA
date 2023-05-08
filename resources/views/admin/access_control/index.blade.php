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
                        <h1 class="m-0 text-dark">Security & Access Control</h1>
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
        <a href="{{ url('list/roles') }}">
            <button class="btn btn-secondary m-2 text-white">
                <span>
                    Roles
                </span>
            </button>
        </a>

        {{-- action bar --}}
        <a href="{{ url('list/permissions') }}">
            <button class="btn btn-secondary m-2 text-white">
                <span>
                    System Permissions
                </span>
            </button>
        </a>

        {{-- action bar --}}
        <a href="{{ url('create_role') }}">
            <button class="btn btn-secondary m-2 text-white">
                <span>
                    Create Role
                </span>
                <span class="ml-2 text-white">
                    <i class="fas fa-plus"></i>
                </span>
            </button>
        </a>
    </div>

@endsection

