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
                        <h1 class="m-0 text-dark">Payment Proof Upload</h1>
                    </div>
                    <!-- /.col -->
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
                {{-- include alert messages --}}
                @include('alerts.messages')

                {{-- main div --}}
                <div class="modal-content bg-primary">
                    <div class="modal-header">
                        <h4 class="modal-title text-dark">
                            <h3 class="card-title">Payment Proof</h3>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('request-store-proof') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- all requisitions --}}
                        <div class="card bg-yellow p-3">
                            {{-- name --}}
                            <div class="text-dark-bg-light p-2">
                                <div>
                                    <label for="">Requisition Name</label>
                                </div>
                                <div>
                                    <select name="req_name" class="form-control">
                                        <option value="" disabled>Choose Requisition</option>
                                        @if (isset($request) && count($request) > 0)
                                            @foreach ($request as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        @else
                                            No requisiton made.
                                        @endif
                                    </select>
                                </div>
                            </div>

                            {{-- start date --}}
                            <div class="text-dark-bg-light p-2">
                                <div>
                                    <label for="">Payment Date</label>
                                </div>
                                <div>
                                    <input type="datetime-local" name="payment_date" class="form-control">
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
                                    <label for="">Report</label>
                                </div>
                                <div>
                                    <textarea name="report" class="form-control" cols="30" rows="10" required></textarea>
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
                            <button type="submit" class="btn btn-primary m-3">
                                Submit Payment Proof
                            </button>
                        </div>
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </div>

    </div>

@endsection
