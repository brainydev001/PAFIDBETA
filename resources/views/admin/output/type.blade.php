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
                        <h1 class="m-0 text-dark">{{ $origin }} Manager</h1>
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

        @if ($origin == 'Crops')
            {{-- action bar --}}
            <button class="btn btn-secondary m-2 text-white" type="button" data-toggle="modal" data-target="#createOutput">
                <span>
                    Create New Crop
                </span>
                <span class="ml-2 text-white">
                    <i class="fas fa-plus"></i>
                </span>
            </button>

            {{-- action bar --}}
            {{-- <button class="btn btn-secondary m-2 text-white" type="button" data-toggle="modal" data-target="#createOutput">
                <span>
                    Purchase Seedlings
                </span>
            </button> --}}

            {{-- action bar --}}
            {{-- <button class="btn btn-secondary m-2 text-white" type="button" data-toggle="modal" data-target="#createOutput">
                <span>
                    Create New Supplier
                </span>
                <span class="ml-2 text-white">
                    <i class="fas fa-plus"></i>
                </span>
            </button> --}}

            {{-- action bar --}}
            {{-- <button class="btn btn-secondary m-2 text-white" type="button" data-toggle="modal" data-target="#createOutput">
                <span>
                    Seedlings Stock List
                </span>
            </button> --}}
        @elseif($origin == 'Stages')
            {{-- action bar --}}
            <button class="btn btn-secondary m-2 text-white" type="button" data-toggle="modal" data-target="#createOutput">
                <span>
                    Create New Planting Stage
                </span>
                <span class="ml-2 text-white">
                    <i class="fas fa-plus"></i>
                </span>
            </button>
        @else
            {{-- action bar --}}
            <button class="btn btn-secondary m-2 text-white" type="button" data-toggle="modal" data-target="#createOutput">
                <span>
                    Create New Fertilizer
                </span>
                <span class="ml-2 text-white">
                    <i class="fas fa-plus"></i>
                </span>
            </button>

            {{-- action bar --}}
            <button class="btn btn-secondary m-2 text-white" type="button" data-toggle="modal" data-target="#createSupplier">
                <span>
                    Create New Supplier
                </span>
                <span class="ml-2 text-white">
                    <i class="fas fa-plus"></i>
                </span>
            </button>

            {{-- action bar --}}
            <button class="btn btn-secondary m-2 text-white" type="button" data-toggle="modal" data-target="#OrderFert">
                <span>
                    Order Fertilizer
                </span>
                <span class="ml-2 text-white">
                    <i class="fas fa-plus"></i>
                </span>
            </button>

            {{-- action bar --}}
            <button class="btn btn-secondary m-2 text-white" type="button" data-toggle="modal" data-target="#createOutput">
                <span>
                    Add Fertilizer Stock
                </span>
                <span class="ml-2 text-white">
                    <i class="fas fa-plus"></i>
                </span>
            </button>
        @endif

        {{-- datatable --}}
        @include('admin.output.inc.datatable')

        {{-- module --}}
        {{-- by type/origin --}}
        @include('admin.output.inc.createorigin_modal')
        {{-- create suppliers --}}
        @include('admin.output.inc.create_supplier_modal')
        {{-- create fertilizer order --}}
        @include('admin.output.inc.order_fert_modal')

    </div>
@endsection

{{-- section custom scripts --}}
@section('adminScripts')
    {{-- include datatable scripts --}}
    @include('admin.output.inc.datatables_script')
@endsection
