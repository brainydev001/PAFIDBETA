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
                        <h1 class="m-0 text-dark">Staff Analytics</h1>
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

            {{-- heading --}}
            <div class="card-header">
                <h3 class="card-title">Data-table showing all Employees and Managers</h3>
            </div>

            <div class="card">

                {{-- heading --}}
                <div class="card-header">
                    Search And Sort Staff Data
                </div>
                {{-- body --}}
                <div class="card-body">

                    {{-- filter staff --}}
                    <button class="btn btn-warning m-2 text-dark" type="button" data-toggle="modal"
                        data-target="#filterStaff">
                        <span>
                            Filter Staff Data
                        </span>
                        <span class="ml-2 text-white">
                            <i class="fas fa-bars"></i>
                        </span>
                    </button>
                    {{-- staff modal --}}
                    @include('admin.analytics.inc.staff_modal')

                </div>
                <!-- /.card-body -->
            </div>
        </div>
        {{-- staff visualization --}}
        <div class="mt-2 mb-2">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Line Chart</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="myChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    @endsection

    {{-- section custom scripts --}}
    @section('adminScripts')
        {{-- include datatable scripts --}}
        @include('admin.analytics.inc.datatables_script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <script>
            var label = JSON.parse('{!! json_encode($months) !!}');
            var data = JSON.parse('{!! json_encode($monthsCount) !!}');
            var myChart = new Chart("myChart", {
                type: "line",
                data: {},
                options: {}
            });
            
        </script>
    @endsection
