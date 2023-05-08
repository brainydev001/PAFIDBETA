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
                        <h1 class="m-0 text-dark">Output Manager</h1>
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

        {{-- input dropdown --}}
        <li class="btn btn-success nav-item dropdown text-white m-2">
            <a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="true" aria-expanded="false">
                <span class="text-white">
                    Farm Output
                </span>
            </a>

            <div class="dropdown-menu bg-light">
                <a class="dropdown-item" href="{{ url('output/Crops') }}"><i class="fas fa-arrow-right p-1 border-bottom text-gray">
                        Crops</i></a>
                <a class="dropdown-item" href="{{ url('output/Stages') }}"><i class="fas fa-arrow-right p-1 border-bottom text-gray">
                        Plantation Stages</i></a>
                <a class="dropdown-item" href="{{ url('output/Fertilizers') }}"><i class="fas fa-arrow-right p-1 border-bottom text-gray">
                        Fertilizers</i></a>
            </div>
        </li>

    </div>
@endsection
