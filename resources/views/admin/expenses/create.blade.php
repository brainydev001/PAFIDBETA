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
                        <h1 class="m-0 text-dark">Create New Expense</h1>
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

                <div class="m-auto">
                    {{-- expense form --}}
                    <form action="{{ route('expense-store') }}" method="post">
                        @csrf
                        <div class="container m-auto">
                            <div class="row m-6">
                                <div class="col-md-10 card bg-yellow p-3">
                                    {{-- name --}}
                                    <div class="text-dark-bg-light p-2">
                                        <div>
                                            <label for="">Select Category</label>
                                        </div>
                                        <div>
                                            <select name="s_category" class="form-control" >
                                                <option value="null">Choose Category</option>
                                                @if (isset($category) && count($category) > 0)
                                                    @foreach ($category as $expense)
                                                        <option value="{{ $expense->category }}">{{ $expense->category }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    {{-- name --}}
                                    <div class="text-dark-bg-light p-2">
                                        <div>
                                            <label for="">Create Category</label>
                                        </div>
                                        <small class="text-red font-bold p-2">
                                            ** Create category ONLY if category name is not on the category select list **
                                        </small>
                                        <div>
                                            <input type="text" name="category" class="form-control">
                                        </div>
                                    </div>
                                    {{-- name --}}
                                    <div class="text-dark-bg-light p-2">
                                        <div>
                                            <label for="">Select Sub Category</label>
                                        </div>
                                        <div>
                                            <select name="s_sub_category" class="form-control">
                                                <option value="null">Choose Sub Category</option>
                                                @if (isset($subCategory) && count($subCategory) > 0)
                                                    @foreach ($subCategory as $expense)
                                                        <option value="{{ $expense->sub_category }}">
                                                            {{ $expense->sub_category }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    {{-- name --}}
                                    <div class="text-dark-bg-light p-2">
                                        <div>
                                            <label for="">Create Sub Category</label>
                                        </div>
                                        <small class="text-red font-bold p-2">
                                            ** Create sub category ONLY if sub category name is not on the sub category
                                            select list **
                                        </small>
                                        <div>
                                            <input type="text" name="sub_category" class="form-control">
                                        </div>
                                    </div>
                                    {{-- input amount --}}
                                    <div class="text-dark-bg-light p-2">
                                        <div>
                                            <label for="">Max Cap Amount</label>
                                        </div>
                                        <div>
                                            <input type="number" class="form-control" required name="max_cap">
                                        </div>
                                    </div>
                                    <div class="text-dark-bg-light p-2">
                                        <div>
                                            <label for="">Note</label>
                                        </div>
                                        <div>
                                            <input type="text" class="form-control" required name="note">
                                        </div>
                                    </div>
                                    <button class="btn btn-success m-3">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </div>

    </div>
@endsection
