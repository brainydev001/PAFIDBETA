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
                        <h1 class="m-0 text-dark"></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
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
                    </div><!-- /.col -->
                </div><!-- /.row -->
                {{-- include alert messages --}}
                @include('alerts.messages')

                {{-- include datatable --}}
                <div class="card">

                    {{-- heading --}}
                    <div class="card-header">
                        <h3 class="card-title">Requisition for activity </h3>
                    </div>

                    {{-- body --}}
                    <div class="card-body">
                        <div class="d-flex">
                            <span>
                                <h5>Amount :</h5>
                            </span>
                            <span class="text-bold ml-3">
                                <h4>
                                    {{ $totals }} (kshs)
                                </h4>
                            </span>
                        </div>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Expense Category</th>
                                    {{-- <th>County</th>
                                    <th>Region</th>
                                    <th>Ward</th> --}}
                                    <th>Activity Name</th>
                                    <th>Requision By</th>
                                    <th>Examined By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if (count($requests) > 0)
                                    @foreach ($requests as $key => $request)
                                        {{-- item --}}
                                        <tr>
                                            <td>{{ $key }}</td>
                                            <td>{{ $request->name }}</td>
                                            <td>{{ $request->amount }}</td>
                                            <td>{{ $request->category }}</td>
                                            {{-- <td>{{ $request->county }}</td>
                                            <td>{{ $request->region_name }}</td>
                                            <td>{{ $request->area_name }}</td> --}}
                                            <td>{{ $request->activities->name }}</td>
                                            <td>{{ $request->created_by_name }}</td>
                                            <td>
                                                @if ($request->rac_id != null)
                                                    @isset($request->examinedBy->first_name)
                                                        {{ $request->examinedBy->first_name }}
                                                        {{ $request->examinedBy->last_name }}
                                                    @endisset
                                                @else
                                                    Pending
                                                @endif
                                            </td>
                                            <td class="border-none">
                                                {{-- approved & examined logic --}}
                                                @if ($request->is_approved == true && $request->is_examined == true && $request->is_pending == false)
                                                    <div class="d-flex">
                                                        @if ($request->is_approved == true && $request->is_pending == false)
                                                            {{-- messenger item --}}
                                                            <div>
                                                                <button class="btn btn-warning m-2 text-white">
                                                                    <span class="p-2">
                                                                        <i class="fas fa-envelope text-blue"></i>
                                                                    </span>
                                                                    <span class="p-2">
                                                                        Notify
                                                                    </span>
                                                                </button>
                                                            </div>
                                                        @else
                                                            <a href="{{ url('approve/reject/admin/' . $request->id) }}">
                                                                <div class="btn sm-btn btn-danger mr-1">
                                                                    Reject
                                                                </div>
                                                            </a>
                                                        @endif
                                                    </div>
                                                @else
                                                    {{-- role check for NAN approved & examined logic --}}
                                                    @if (Auth::user()->hasRole('Managment') || Auth::user()->hasRole('System'))
                                                        <div class="d-flex">
                                                            <a href="{{ url('approve/approve/admin/' . $request->id) }}">
                                                                <div class="btn sm-btn btn-success mr-1">
                                                                    Approve
                                                                </div>
                                                            </a>
                                                            <button class="btn sm-btn btn-secondary text-white"
                                                                type="button" data-toggle="modal" data-target="#amend">
                                                                <span>
                                                                    Amend
                                                                </span>
                                                            </button>
                                                            {{-- include modal --}}
                                                            <div class="modal fade" id="amend">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content bg-primary">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title text-dark">
                                                                                <h3 class="card-title">Amend</h3>
                                                                            </h4>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span
                                                                                    aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        {{-- amend form --}}
                                                                        <form
                                                                            action="{{ route('amend_request', [$request->id]) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            {{-- all requisitions --}}
                                                                            <div class="card bg-yellow p-3">
                                                                                {{-- name --}}
                                                                                <div class="text-dark-bg-light p-2">
                                                                                    <div>
                                                                                        <label for="">Name</label>
                                                                                    </div>
                                                                                    <div>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="name"
                                                                                            value="{{ $request->name }}"
                                                                                            placeholder="{{ $request->name }}">
                                                                                    </div>
                                                                                </div>
                                                                                {{-- details --}}
                                                                                <div class="text-dark-bg-light p-2">
                                                                                    <div>
                                                                                        <label
                                                                                            for="">Details</label>
                                                                                    </div>
                                                                                    <div>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="details"
                                                                                            value="{{ $request->details }}"
                                                                                            placeholder="{{ $request->details }}">
                                                                                    </div>
                                                                                </div>
                                                                                {{-- amount --}}
                                                                                <div class="text-dark-bg-light p-2">
                                                                                    <div>
                                                                                        <label for="">Amount</label>
                                                                                    </div>
                                                                                    <div>
                                                                                        <input type="number"
                                                                                            class="form-control"
                                                                                            name="amount"
                                                                                            value="{{ $request->amount }}"
                                                                                            placeholder="{{ $request->amount }}">
                                                                                    </div>
                                                                                </div>
                                                                                {{-- btn --}}
                                                                                <button class="btn btn-success m-3">
                                                                                    Amend
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    </form>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                        </div>
                                                    @elseif(Auth::user()->hasRole('R.C'))
                                                        @if ($request->is_pending == false)
                                                            <div class="d-flex">
                                                                <a href="{{ url('approve/examin/rac/' . $request->id) }}">
                                                                    <div class="btn sm-btn btn-success mr-1">
                                                                        Examin
                                                                    </div>
                                                                </a>
                                                                <button class="btn sm-btn btn-secondary text-white"
                                                                    type="button" data-toggle="modal" data-target="#amend">
                                                                    <span>
                                                                        Amend
                                                                    </span>
                                                                </button>
                                                                {{-- include modal --}}
                                                                <div class="modal fade" id="amend">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content bg-primary">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title text-dark">
                                                                                    <h3 class="card-title">Amend</h3>
                                                                                </h4>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span
                                                                                        aria-hidden="true">&times;</span></button>
                                                                            </div>
                                                                            {{-- amend form --}}
                                                                            <form
                                                                                action="{{ route('amend_request', [$request->id]) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                {{-- all requisitions --}}
                                                                                <div class="card bg-yellow p-3">
                                                                                    {{-- name --}}
                                                                                    <div class="text-dark-bg-light p-2">
                                                                                        <div>
                                                                                            <label
                                                                                                for="">Name</label>
                                                                                        </div>
                                                                                        <div>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                name="name"
                                                                                                value="{{ $request->name }}"
                                                                                                placeholder="{{ $request->name }}">
                                                                                        </div>
                                                                                    </div>
                                                                                    {{-- details --}}
                                                                                    <div class="text-dark-bg-light p-2">
                                                                                        <div>
                                                                                            <label
                                                                                                for="">Details</label>
                                                                                        </div>
                                                                                        <div>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                name="details"
                                                                                                value="{{ $request->details }}"
                                                                                                placeholder="{{ $request->details }}">
                                                                                        </div>
                                                                                    </div>
                                                                                    {{-- amount --}}
                                                                                    <div class="text-dark-bg-light p-2">
                                                                                        <div>
                                                                                            <label
                                                                                                for="">Amount</label>
                                                                                        </div>
                                                                                        <div>
                                                                                            <input type="number"
                                                                                                class="form-control"
                                                                                                name="amount"
                                                                                                value="{{ $request->amount }}"
                                                                                                placeholder="{{ $request->amount }}">
                                                                                        </div>
                                                                                    </div>
                                                                                    {{-- btn --}}
                                                                                    <button class="btn btn-success m-3">
                                                                                        Amend
                                                                                    </button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        </form>
                                                                        <!-- /.modal-content -->
                                                                    </div>
                                                                    <!-- /.modal-dialog -->
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div>
                                                                <button class="btn btn-warning m-2 text-white">
                                                                    <span class="p-2">
                                                                        <i class="fas fa-envelope text-blue"></i>
                                                                    </span>
                                                                    <span class="p-2">
                                                                        Notify Region Members
                                                                    </span>
                                                                </button>
                                                            </div>
                                                        @endif
                                                    @elseif(Auth::user()->hasRole('A.C'))
                                                        <div class="d-flex">
                                                            <a href="{{ url('approve/delete/AC/' . $request->id) }}">
                                                                <div class="btn sm-btn btn-danger">
                                                                    Delete
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @elseif(Auth::user()->hasRole('Staff'))
                                                        <div class="d-flex">
                                                            <a href="{{ url('approve/approve/admin/' . $request->id) }}">
                                                                <div class="btn sm-btn btn-success mr-1">
                                                                    Approve
                                                                </div>
                                                            </a>
                                                            <button class="btn sm-btn btn-secondary text-white"
                                                                type="button" data-toggle="modal" data-target="#amend">
                                                                <span>
                                                                    Amend
                                                                </span>
                                                            </button>
                                                            {{-- include modal --}}
                                                            <div class="modal fade" id="amend">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content bg-primary">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title text-dark">
                                                                                <h3 class="card-title">Amend</h3>
                                                                            </h4>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span
                                                                                    aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        {{-- amend form --}}
                                                                        <form
                                                                            action="{{ route('amend_request', [$request->id]) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            {{-- all requisitions --}}
                                                                            <div class="card bg-yellow p-3">
                                                                                {{-- name --}}
                                                                                <div class="text-dark-bg-light p-2">
                                                                                    <div>
                                                                                        <label for="">Name</label>
                                                                                    </div>
                                                                                    <div>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="name"
                                                                                            value="{{ $request->name }}"
                                                                                            placeholder="{{ $request->name }}">
                                                                                    </div>
                                                                                </div>
                                                                                {{-- details --}}
                                                                                <div class="text-dark-bg-light p-2">
                                                                                    <div>
                                                                                        <label
                                                                                            for="">Details</label>
                                                                                    </div>
                                                                                    <div>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="details"
                                                                                            value="{{ $request->details }}"
                                                                                            placeholder="{{ $request->details }}">
                                                                                    </div>
                                                                                </div>
                                                                                {{-- amount --}}
                                                                                <div class="text-dark-bg-light p-2">
                                                                                    <div>
                                                                                        <label
                                                                                            for="">Amount</label>
                                                                                    </div>
                                                                                    <div>
                                                                                        <input type="number"
                                                                                            class="form-control"
                                                                                            name="amount"
                                                                                            value="{{ $request->amount }}"
                                                                                            placeholder="{{ $request->amount }}">
                                                                                    </div>
                                                                                </div>
                                                                                {{-- btn --}}
                                                                                <button class="btn btn-success m-3">
                                                                                    Amend
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    </form>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                        </div>
                                                    @elseif(Auth::user()->hasRole('System'))
                                                        <div class="d-flex">
                                                            <a href="{{ url('request/approve/admin/' . $request->id) }}">
                                                                <div class="btn sm-btn btn-success mr-1">
                                                                    Approve
                                                                </div>
                                                            </a>
                                                            <button class="btn sm-btn btn-secondary text-white"
                                                                type="button" data-toggle="modal" data-target="#amend">
                                                                <span>
                                                                    Amend
                                                                </span>
                                                            </button>
                                                            {{-- include modal --}}
                                                            <div class="modal fade" id="amend">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content bg-primary">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title text-dark">
                                                                                <h3 class="card-title">Amend</h3>
                                                                            </h4>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span
                                                                                    aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        {{-- amend form --}}
                                                                        <form
                                                                            action="{{ route('amend_request', [$request->id]) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            {{-- all requisitions --}}
                                                                            <div class="card bg-yellow p-3">
                                                                                {{-- name --}}
                                                                                <div class="text-dark-bg-light p-2">
                                                                                    <div>
                                                                                        <label for="">Name</label>
                                                                                    </div>
                                                                                    <div>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="name"
                                                                                            value="{{ $request->name }}"
                                                                                            placeholder="{{ $request->name }}">
                                                                                    </div>
                                                                                </div>
                                                                                {{-- details --}}
                                                                                <div class="text-dark-bg-light p-2">
                                                                                    <div>
                                                                                        <label
                                                                                            for="">Details</label>
                                                                                    </div>
                                                                                    <div>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="details"
                                                                                            value="{{ $request->details }}"
                                                                                            placeholder="{{ $request->details }}">
                                                                                    </div>
                                                                                </div>
                                                                                {{-- amount --}}
                                                                                <div class="text-dark-bg-light p-2">
                                                                                    <div>
                                                                                        <label
                                                                                            for="">Amount</label>
                                                                                    </div>
                                                                                    <div>
                                                                                        <input type="number"
                                                                                            class="form-control"
                                                                                            name="amount"
                                                                                            value="{{ $request->amount }}"
                                                                                            placeholder="{{ $request->amount }}">
                                                                                    </div>
                                                                                </div>
                                                                                {{-- btn --}}
                                                                                <button class="btn btn-success m-3">
                                                                                    Amend
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    </form>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                            <a href="{{ url('request/reject/admin/' . $request->id) }}">
                                                                <div class="btn sm-btn btn-danger mr-1">
                                                                    Reject
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="d-flex">
                                                            <a href="{{ url('request/approve/admin/' . $request->id) }}">
                                                                <div class="btn sm-btn btn-success mr-1">
                                                                    Approve
                                                                </div>
                                                            </a>
                                                            <button class="btn sm-btn btn-secondary text-white"
                                                                type="button" data-toggle="modal" data-target="#amend">
                                                                <span>
                                                                    Amend
                                                                </span>
                                                            </button>
                                                            {{-- include modal --}}
                                                            <div class="modal fade" id="amend">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content bg-primary">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title text-dark">
                                                                                <h3 class="card-title">Amend</h3>
                                                                            </h4>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span
                                                                                    aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        {{-- amend form --}}
                                                                        <form
                                                                            action="{{ route('amend_request', [$request->id]) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            {{-- all requisitions --}}
                                                                            <div class="card bg-yellow p-3">
                                                                                {{-- name --}}
                                                                                <div class="text-dark-bg-light p-2">
                                                                                    <div>
                                                                                        <label for="">Name</label>
                                                                                    </div>
                                                                                    <div>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="name"
                                                                                            value="{{ $request->name }}"
                                                                                            placeholder="{{ $request->name }}">
                                                                                    </div>
                                                                                </div>
                                                                                {{-- details --}}
                                                                                <div class="text-dark-bg-light p-2">
                                                                                    <div>
                                                                                        <label
                                                                                            for="">Details</label>
                                                                                    </div>
                                                                                    <div>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="details"
                                                                                            value="{{ $request->details }}"
                                                                                            placeholder="{{ $request->details }}">
                                                                                    </div>
                                                                                </div>
                                                                                {{-- amount --}}
                                                                                <div class="text-dark-bg-light p-2">
                                                                                    <div>
                                                                                        <label
                                                                                            for="">Amount</label>
                                                                                    </div>
                                                                                    <div>
                                                                                        <input type="number"
                                                                                            class="form-control"
                                                                                            name="amount"
                                                                                            value="{{ $request->amount }}"
                                                                                            placeholder="{{ $request->amount }}">
                                                                                    </div>
                                                                                </div>
                                                                                {{-- btn --}}
                                                                                <button class="btn btn-success m-3">
                                                                                    Amend
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    </form>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>

                                                            <a href="{{ url('request/reject/admin/' . $request->id) }}">
                                                                <div class="btn sm-btn btn-danger mr-1">
                                                                    Reject
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Expense Category</th>
                                    {{-- <th>County</th>
                                    <th>Region</th>
                                    <th>Ward</th> --}}
                                    <th>Activity Name</th>
                                    <th>Requision By</th>
                                    <th>Examined By</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>

@endsection

{{-- section custom scripts --}}
@section('adminScripts')
    {{-- include datatable scripts --}}
    @include('admin.requisition.inc.datatables_script')
@endsection
