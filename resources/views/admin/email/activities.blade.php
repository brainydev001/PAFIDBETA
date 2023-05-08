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
                        <h1 class="m-0 text-dark">Activity List</h1>
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
                <div class="col-12">
                    {{-- include alert messages --}}
                    @include('alerts.messages')

                    {{-- data card --}}
                    <div class="card">

                        {{-- heading --}}
                        <div class="card-header">
                            <h3 class="card-title">Data-table for activities</h3>
                        </div>

                        {{-- body --}}
                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Start Date</th>
                                        <th>Start Time</th>
                                        <th>End Date</th>
                                        <th>End Time</th>
                                        <th>County</th>
                                        <th>Region</th>
                                        <th>Ward</th>
                                        <th>Created By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($datas) && count($datas) > 0)
                                        @foreach ($datas as $data)
                                            {{-- item --}}
                                            <tr>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->start_date }}</td>
                                                <td>{{ $data->start_time }}hrs</td>
                                                <td>{{ $data->end_date }}</td>
                                                <td>{{ $data->end_time }}hrs</td>
                                                <td>{{ $data->county }}</td>
                                                <td>{{ $data->regions->name }}</td>
                                                <td>{{ $data->area_name }}</td>
                                                <td>{{ $data->created_by_name }}</td>
                                                <td class="border-none d-flex">
                                                    <a href="{{ url('activity-attendance/' . $data->id) }}" class="ml-4">
                                                        <i class="fa fa-eye text-green"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        Opps No Activity Found !!!.
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Start Date</th>
                                        <th>Start Time</th>
                                        <th>End Date</th>
                                        <th>End Time</th>
                                        <th>County</th>
                                        <th>Region</th>
                                        <th>Ward</th>
                                        <th>Created By</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>


    </div>
@endsection

{{-- section custom scripts --}}
@section('adminScripts')
    {{-- include datatable scripts --}}
    @include('admin.activities.inc.datatables_script')
@endsection
