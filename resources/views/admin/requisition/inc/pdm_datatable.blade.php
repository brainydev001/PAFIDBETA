{{-- membership datatable --}}

{{-- data card --}}
<div class="card">

    {{-- heading --}}
    <div class="card-header">
        <h3 class="card-title">All Per Diems</h3>
    </div>

    {{-- body --}}
    <div class="card-body">

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Activity Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Duration</th>
                    <th>Total Amount</th>
                    <th>Created By</th>
                    <th>Note</th>
                    <th>Download File</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @if (count($pdms) > 0)
                    @foreach ($pdms as $pdm)
                        {{-- item --}}
                        <tr>
                            <td>{{ $pdm->name }}</td>
                            <td>{{ $pdm->start_date }}</td>
                            <td>{{ $pdm->end_date }}</td>
                            @php
                                $sDate = $pdm->start_date;
                                $sDay = explode('-', $sDate)[2];
                                $eDate = $pdm->end_date;
                                $eDay = explode('-', $eDate)[2];
                                $duration = (int) $eDay - (int) $sDay;
                            @endphp
                            <td>
                                @isset($duration)
                                    {{ $duration }} days
                                @endisset
                            </td>
                            <td>{{ $pdm->amount }}</td>
                            <td>
                                {{ $pdm->users->first_name }}
                                {{ $pdm->users->last_name }}
                            </td>
                            <td>{{ $pdm->note }}</td>
                            <td>
                                <a href="" class="btn sm-btn btn-primary">
                                    <small>Download</small>
                                </a>
                            </td>
                            <td class="border-none">
                                @if ($pdm->is_approved == true)
                                    <div class="d-flex">
                                        <a href="{{ url('approve/reject/pdm/' . $pdm->id) }}">
                                            <div class="btn sm-btn btn-danger mr-1">
                                                Reject
                                            </div>
                                        </a>
                                    </div>
                                @else
                                    @if (Auth::user()->hasRole('System') || Auth::user()->hasRole('Managment') || Auth::user()->hasRole('Staff'))
                                        <div class="d-flex">
                                            <a href="{{ url('approve/approve/pdm/' . $pdm->id) }}">
                                                <div class="btn sm-btn btn-success mr-1">
                                                    Approve
                                                </div>
                                            </a>
                                            <a href="{{ url('approve/reject/pdm/' . $pdm->id) }}">
                                                <div class="btn sm-btn btn-danger mr-1">
                                                    Reject
                                                </div>
                                            </a>
                                        </div>
                                    @else
                                        <div class="d-flex">
                                            <a href="{{ url('approve/examin/pdm/' . $pdm->id) }}">
                                                <div class="btn sm-btn btn-success mr-1">
                                                    Examin
                                                </div>
                                            </a>
                                            <a href="{{ url('approve/reject/pdm/' . $pdm->id) }}">
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
                    <th>Activity Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Duration</th>
                    <th>Total Amount</th>
                    <th>Created By</th>
                    <th>Note</th>
                    <th>Download File</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
