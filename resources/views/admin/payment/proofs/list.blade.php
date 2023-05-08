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
                        <h1 class="m-0 text-dark">Payment Proof</h1>
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

        {{-- datatable --}}
        {{-- activity or event or module datatable --}}

        {{-- data card --}}
        <div class="card">

            {{-- heading --}}
            <div class="card-header">
                <h3 class="card-title">Data-table for payment proof</h3>
            </div>

            {{-- body --}}
            <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Requisition Name</th>
                            <th>Payment Date</th>
                            <th>Cumulative Amount</th>
                            <th>Expense Category</th>
                            <th>Report</th>
                            <th>Note</th>
                            <th>Uploaded By</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (isset($datas) && count($datas) > 0)
                            @foreach ($datas as $data)
                                {{-- item --}}
                                <tr>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->payment_date }}</td>
                                    <td>
                                        {{ $data->amount }}
                                    </td>
                                    <td>{{ $data->category }}</td>
                                    <td>
                                        <p>
                                            {{ $data->report }}
                                        </p>
                                    </td>
                                    <td>{{ $data->details }}</td>
                                    <td>{{ $data->createdBy->first_name }}
                                        {{ $data->createdBy->last_name }}
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            Opps No Payment Proofs Found !!!.
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Requisition Name</th>
                            <th>Payment Date</th>
                            <th>Cumulative Amount</th>
                            <th>Expense Category</th>
                            <th>Report</th>
                            <th>Note</th>
                            <th>Uploaded By</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>


    </div>
@endsection

{{-- section custom scripts --}}
@section('adminScripts')
    {{-- include datatable scripts --}}
    @include('admin.payment.inc.datatables_script')
@endsection
