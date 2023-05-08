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
                        <h1 class="m-0 text-dark">OTP Manager</h1>
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
                    {{-- datatable --}}
                    {{-- data card --}}
                    <div class="card">

                        {{-- heading --}}
                        <div class="card-header">
                            <h3 class="card-title">Data-table showing all User OTPs</h3>
                        </div>

                        {{-- body --}}
                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>OTP</th>
                                        <th>User</th>
                                        <th>Phone Number</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (count($otps) > 0)
                                        @foreach ($otps as $log)
                                            {{-- item --}}
                                            <tr>
                                                <td>
                                                    <p>
                                                        {{ $log->otp }}
                                                    </p>
                                                </td>
                                                <td>
                                                    @isset($log->users->first_name)
                                                        {{ $log->users->first_name }}
                                                        {{ $log->users->last_name }}
                                                    @endisset
                                                </td>
                                                <td>
                                                    @isset($log->users->phone_number)
                                                        {{ $log->users->phone_number }}
                                                    @endisset
                                                </td>
                                                <td>
                                                    @if ($log->verified == true)
                                                        <div class="btn sm-btn btn-secondary ml-2">
                                                            <span class="p-2">
                                                                <i class="fas fa-check"></i>
                                                            </span>
                                                            <span class="p-2">
                                                                User Verified
                                                            </span>
                                                        </div>
                                                    @else
                                                        <div class="d-flex">
                                                            <div class="btn sm-btn btn-danger ml-2">
                                                                <span class="p-2">
                                                                    <i class="fas fa-ban"></i>
                                                                </span>
                                                                <span class="p-2">
                                                                    Pending Verification
                                                                </span>
                                                            </div>
                                                            <div class="btn sm-btn btn-warning ml-2">
                                                                <span class="p-2">
                                                                    <i class="fas fa-recycle"></i>
                                                                </span>
                                                                <span class="p-2">
                                                                    Resend O.T.P
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <p>
                                            No user otp available
                                        </p>
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>OTP</th>
                                        <th>User</th>
                                        <th>Phone Number</th>
                                        <th>Details</th>
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
    @include('admin.logs.inc.datatables_script')
@endsection
