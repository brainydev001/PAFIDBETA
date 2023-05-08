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
                        <h1 class="m-0 text-dark">Requisition Manager</h1>
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

        @if (Auth::user()->hasRole('System') || Auth::user()->hasRole('Managment') || Auth::user()->hasRole('Staff'))
            {{-- action bar --}}
            <a href="{{ url('request-activity/Admin') }}">
                <button class="btn btn-secondary m-2 text-white">
                    <span>
                        Activity Requisitions
                    </span>
                </button>
            </a>
            <a href="{{ url('request-pdm/Admin') }}">
                <button class="btn btn-secondary m-2 text-white">
                    <span>
                        Per Diems
                    </span>
                </button>
            </a>
        @elseif(Auth::user()->hasRole('R.C'))
            {{-- action bar --}}
            <a href="{{ url('request-activity/RC') }}">
                <button class="btn btn-secondary m-2 text-white">
                    <span>
                        Activity Requisitions
                    </span>
                </button>
            </a>
            <a href="{{ url('request-pdm/RC') }}">
                <button class="btn btn-secondary m-2 text-white">
                    <span>
                        Per Diems
                    </span>
                </button>
            </a>
        @elseif(Auth::user()->hasRole('A.C'))
            {{-- action bar --}}
            <a href="{{ url('request-activity/AC') }}">
                <button class="btn btn-secondary m-2 text-white">
                    <span>
                        Activity Requisitions
                    </span>
                </button>
            </a>
            <a href="{{ url('request-pdm/AC') }}">
                <button class="btn btn-secondary m-2 text-white">
                    <span>
                        Per Diems
                    </span>
                </button>
            </a>
        @endif
    </div>
@endsection
