{{-- membership datatable --}}

{{-- data card --}}
<div class="card">

    {{-- heading --}}
    <div class="card-header">
        <h3 class="card-title">All Activities</h3>
    </div>

    {{-- body --}}
    <div class="card-body">

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>County</th>
                    <th>Sub County</th>
                    <th>Ward</th>
                    <th>Created By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @if (count($activities) > 0)
                    @foreach ($activities as $activity)
                        {{-- item --}}
                        <tr>
                            <td>{{ $activity->name }}</td>
                            <td>{{ $activity->county }}</td>
                            <td>{{ $activity->sub_county }}</td>
                            <td>{{ $activity->area_name }}</td>
                            <td>{{ $activity->created_by_name }}</td>
                            <td class="border-none">
                                <a href="{{ url('make-requisition/Admin/'.$activity->id) }}">
                                    <button class="btn btn-warning">
                                        Make Requisition
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>County</th>
                    <th>Sub County</th>
                    <th>Ward</th>
                    <th>Created By</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>

