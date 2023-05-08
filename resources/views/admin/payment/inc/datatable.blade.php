{{-- activity or event or module datatable --}}

{{-- data card --}}
<div class="card ">

    {{-- heading --}}
    <div class="card-header">
        <h3 class="card-title">Data-table for approved {{ $type }}</h3>
    </div>

    {{-- body --}}
    <div class="card-body">
        <h4 class="mt-2 mb-2">
            Total Amount : {{ $totals }}
        </h4>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    {{-- <th>Start Date</th>
                    <th>End Date</th> --}}
                    <th>Duration</th>
                    <th>Activity Name</th>
                    <th>Amount</th>
                    <th>Expense Category</th>
                    <th>Requested By</th>
                    <th>Examined By</th>
                    @if ($type == 'Budget' || $type == 'Reciepts')
                        <th>Approved By</th>
                    @endif
                    @if ($type == 'Reciepts')
                        <th>Disbursed By</th>
                    @endif
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @if (isset($datas) && count($datas) > 0)
                    @foreach ($datas as $data)
                        {{-- item --}}
                        <tr>
                            <td>{{ $data->name }}</td>
                            {{-- <td>{{ $data->activities->start_date }}</td>
                            <td>{{ $data->activities->end_date }}</td> --}}
                            @php
                                $sDate = $data->activities->start_date;
                                $sDay = explode('-', $sDate)[2];
                                $eDate = $data->activities->end_date;
                                $eDay = explode('-', $eDate)[2];
                                $duration = (int) $eDay - (int) $sDay;
                            @endphp
                            <td>
                                @isset($duration)
                                    {{ $duration }} days
                                @endisset
                            </td>
                            <td>{{ $data->activities->name }}</td>
                            <td>{{ $data->amount }}</td>
                            <td>{{ $data->category }}</td>
                            @if ($type == 'Budget' || $type == 'Reciepts')
                                <td>{{ $data->requisitions->created_by_name }}</td>
                                <td>
                                    @isset($data->requisitions->examinedBy->first_name)
                                        {{ $data->requisitions->examinedBy->first_name }} {{ $data->requisitions->examinedBy->last_name }}
                                    @endisset
                                </td>
                                <td>{{ $data->requisitions->approved_by_name }}</td>
                            @else
                                <td>{{ $data->created_by_name }}</td>
                                <td>
                                    @isset($data->examinedBy->first_name)
                                        {{ $data->examinedBy->first_name }} {{ $data->examinedBy->last_name }}
                                    @endisset
                                </td>
                            @endif
                            @if ($type == 'Reciepts')
                                <td>
                                    @isset($data->disbursedBy->first_name)
                                        {{ $data->disbursedBy->first_name }} {{ $data->disbursedBy->last_name }}
                                    @endisset
                                </td>
                            @endif
                            <td class="">
                                <div class="">
                                    @if ($data->is_disbursed == true && $type == 'Invoices')
                                        <a href="{{ url('approve/reject/invoice/' . $data->id) }}">
                                            <div class="btn sm-btn btn-danger mr-1 mb-1">
                                                Reject
                                            </div>
                                        </a>
                                    @elseif($data->is_disbursed == false && $type == 'Invoices')
                                        <div class="d-flex">
                                            <a href="{{ url('approve/disburse/invoice/' . $data->id) }}">
                                                <div class="btn sm-btn btn-warning mr-1">
                                                    Approve
                                                </div>
                                            </a>
                                            <a href="{{ url('approve/reject/invoice/' . $data->id) }}">
                                                <div class="btn sm-btn btn-danger mr-1">
                                                    Reject
                                                </div>
                                            </a>
                                        </div>
                                    @elseif($type == 'Budget')
                                        <a href="{{ url('approve/confirm/budget/' . $data->id) }}">
                                            <div class="btn sm-btn btn-warning mr-1">
                                                Disburse
                                            </div>
                                        </a>
                                    @elseif($type == 'Reciepts')
                                        <a href="{{ url('approve/confirm/budget/' . $data->id) }}">
                                            <div class="btn sm-btn btn-success mr-1">
                                                Confirm
                                            </div>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    Opps No Requisitions Found !!!.
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    {{-- <th>Start Date</th>
                    <th>End Date</th> --}}
                    <th>Duration</th>
                    <th>Activity Name</th>
                    <th>Amount</th>
                    <th>Expense Category</th>
                    <th>Requested By</th>
                    <th>Examined By</th>
                    @if ($type == 'Budget' || $type == 'Reciepts')
                        <th>Approved By</th>
                    @endif
                    @if ($type == 'Reciepts')
                        <th>Disbursed By</th>
                    @endif
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
