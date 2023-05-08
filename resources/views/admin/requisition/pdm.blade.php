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
                </div>
                <!-- /.row -->
                {{-- include alert messages --}}
                @include('alerts.messages')

                {{-- main div --}}
                <div class="modal-content bg-warning">
                    <div class="modal-header">
                        <h4 class="modal-title text-dark">
                            <h3 class="card-title">Per Diem Requisitions</h3>
                        </h4>
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('request-store-pdm') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- all requisitions --}}
                        <div class="card bg-light p-3">
                            {{-- name --}}
                            <div class="text-dark bg-light p-2">
                                <div>
                                    <label for="">Per Deim Activity Name</label>
                                </div>
                                <div>
                                    <select name="activity_name" class="form-control">
                                        <option value="" disabled>Choose Activity</option>
                                        @if (count($activities) > 0)
                                            @foreach ($activities as $activity)
                                                <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                                            @endforeach
                                        @else
                                            No activity created.
                                        @endif
                                    </select>
                                </div>
                            </div>

                            {{-- start date --}}
                            <div class="text-dark-bg-light p-2">
                                <div>
                                    <label for="">Start Date</label>
                                </div>
                                <div>
                                    <input type="datetime-local" name="start_date" class="form-control">
                                </div>
                            </div>

                            {{-- end date --}}
                            <div class="text-dark-bg-light p-2">
                                <div>
                                    <label for="">End Date</label>
                                </div>
                                <div>
                                    <input type="datetime-local" name="end_date" class="form-control">
                                </div>
                            </div>

                            {{-- file  --}}
                            <div class="text-dark-bg-light p-2">
                                <div>
                                    <label for="">Supporting Files</label>
                                </div>
                                <div>
                                    <input type="file" name="file" class="form-control">
                                </div>
                            </div>
                            {{-- input amount --}}
                            <div class="text-dark-bg-light p-2">
                                <div>
                                    <label for="">Cumulative Amount</label>
                                </div>
                                <div>
                                    <input type="number" class="form-control" name="amount" required>
                                </div>
                            </div>
                            {{-- others --}}
                            <div class="text-dark-bg-light p-2">
                                <div>
                                    <label for="">Note</label>
                                </div>
                                <div>
                                    <input type="text" class="form-control" name="note" required>
                                </div>
                            </div>

                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success m-3">
                                Submit Per Diem Requisition
                            </button>
                        </div>
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>

@endsection
