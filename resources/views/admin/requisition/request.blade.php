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
                </div><!-- /.row -->
                <div>
                    {{-- include alert messages --}}
                    @include('alerts.messages')

                    {{-- main div --}}
                    <div class="modal-content bg-warning">
                        <div class="modal-header">
                            <h4 class="modal-title text-dark">
                                <h3 class="card-title">Make Requisitions For {{ $activity->name }}</h3>
                            </h4>
                            <button type="button" class="close"  aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('request-store', [$type, $id]) }}" method="post">
                            @csrf
                            {{-- all requisitions --}}
                            <div class="card bg-yellow p-3">
                                {{-- name --}}
                                <div class="text-dark-bg-light p-2">
                                    <div>
                                        <label for="">Requisition Name</label>
                                    </div>
                                    <div>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                </div>

                                {{-- category --}}
                                <div class="text-dark-bg-light p-2">
                                    <div>
                                        <label for="">Expense Category</label>
                                    </div>
                                    <div>
                                        <select name="category" class="form-control" required>
                                            @isset($category)
                                                @foreach ($category as $expense)
                                                    <option value="{{ $expense->category }}">{{ $expense->category }}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                </div>

                                {{-- sub_category --}}
                                <div class="text-dark-bg-light p-2">
                                    <div>
                                        <label for="">Expense Sub Category</label>
                                    </div>
                                    <div>
                                        <select name="sub_category" class="form-control" required>
                                            @if (isset($subCategory) && count($subCategory) > 0)
                                                @foreach ($subCategory as $expense)
                                                    <option value="{{ $expense->sub_category }}">
                                                        {{ $expense->sub_category }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                {{-- input amount --}}
                                <div class="text-dark-bg-light p-2">
                                    <div>
                                        <label for="">Amount</label>
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
                                <button type="submit" class="btn btn-success m-3 text-center">
                                    Submit Requisition
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>



    </div>

@endsection
