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
                        <h1 class="m-0 text-dark">Backup Manager</h1>
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
                <div>
                    {{-- include alert messages --}}
                    @include('alerts.messages')
                    <button class="btn btn-secondary m-2 text-white" data-toggle="modal" data-target="#backup">
                        <span>
                            Create Backup
                        </span>
                        <span class="ml-2 text-white">
                            <i class="fas fa-plus"></i>
                        </span>
                    </button>

                    {{-- auth backup modal --}}
                    <div class="modal fade" id="backup">
                        <div class="modal-dialog">
                            <div class="modal-content bg-primary">
                                <div class="modal-header">
                                    <h4 class="modal-title text-dark">
                                        <h3 class="card-title">Backup Authentication Modal</h3>
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('backup-create', ['type' => 'public']) }}" method="post">
                                    @csrf
                                    {{-- backup --}}
                                    <div class="card bg-yellow p-3">
                                        <div class="text-dark-bg-light p-2">
                                            <div>
                                                {{-- label --}}
                                                <label for="">Database Name</label>
                                            </div>
                                            <div>
                                                {{-- input --}}
                                                <input type="text" name="username" class="form-control">
                                            </div>
                                        </div>

                                        {{--  --}}
                                        <div class="text-dark-bg-light p-2">
                                            <div>
                                                {{-- label --}}
                                                <label for="">Password</label>
                                            </div>
                                            <div>
                                                {{-- input --}}
                                                <input type="text" name="passcode" class="form-control">
                                            </div>
                                        </div>
                                        {{--  --}}
                                        <button class="btn btn-success">
                                            Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                            </form>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    {{-- end backup auth --}}
                    <a href="">
                        <button class="btn btn-secondary m-2 text-white">
                            <span>
                                View Backup Logs
                            </span>
                            <span class="ml-2 text-white">
                                <i class="fas fa-eye"></i>
                            </span>
                        </button>
                    </a>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>
@endsection

@section('admin.js')
    {{-- datatable js --}}
    @include('admin.backup.inc.datatables_script')
@endsection
