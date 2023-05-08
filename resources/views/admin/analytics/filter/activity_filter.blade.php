@extends('layouts.datatable')

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
                        <h1 class="m-0 text-dark">Activity Report</h1>
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
                {{-- include alert messages --}}
                @include('alerts.messages')

                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="pull-left">
                                        <h2 class="card-title">
                                            <small class="text-green font-weight-bold">
                                                USE THE BUTTONS BELOW TO DOWNLOAD THE DOCUMENT IN DIFFERENT FORMATS.
                                            </small>
                                        </h2>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="quiztable">
                                            <thead class="text-darken mt-3 p-2">
                                                <th style="width:5%">No.</th>
                                                <th>Name</th>
                                                <th>County</th>
                                                <th>Sub County</th>
                                                <th>Region</th>
                                                <th>Ward</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Note</th>
                                                <th>Recorded By</th>
                                                <th class="not-export-col"></th>
                                            </thead>
                                            <tbody>
                                                @if (count($activities) > 0)
                                                    @foreach ($activities as $row)
                                                        <tr>
                                                            <td>
                                                                {{ $loop->index + 1 }}
                                                            </td>
                                                            <td>
                                                                {{ $row->name }}
                                                            </td>
                                                            <td>
                                                                {{ $row->county }}
                                                            </td>
                                                            <td>
                                                                {{ $row->sub_county }}
                                                            </td>
                                                            <td>
                                                                {{ $row->regions->name }}
                                                            </td>
                                                            <td>
                                                                {{ $row->area_name }}
                                                            </td>
                                                            <td>
                                                                {{ $row->start_date }}
                                                            </td>
                                                            <td>
                                                                {{ $row->end_date }}
                                                            </td>
                                                            <td>
                                                                <small>
                                                                    {{ $row->note ?? 'Note not provided' }}
                                                                </small>
                                                            </td>
                                                            <td>
                                                                {{ $row->created_by_name }}
                                                            </td>
                                                            <td>

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    Opps!! No data match
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>


    </div>
@endsection

{{-- section custom scripts --}}
@section('adminScripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#quiztable').DataTable({
                dom: "Blfrtip",
                buttons: [{
                        text: 'C.S.V',
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        }
                    },
                    {
                        text: 'EXCEL',
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        }
                    },
                    {
                        text: 'P.D.F',
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        }
                    },
                    // {
                    //     text: 'print',
                    //     extend: 'print',
                    //     exportOptions: {
                    //         columns: ':visible:not(.not-export-col)'
                    //     }
                    // },

                ],
                columnDefs: [{
                    orderable: false,
                    targets: -1
                }]
            });
        });
    </script>
@endsection
