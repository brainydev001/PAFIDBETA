{{-- activity or event or module datatable --}}

{{-- data card --}}
<div class="card">

    {{-- heading --}}
    <div class="card-header">
        <h3 class="card-title">Data-table for activities</h3>
    </div>

    {{-- body --}}
    <div class="card-body">

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Start Date</th>
                    <th>Start Time</th>
                    <th>End Date</th>
                    <th>End Time</th>
                    <th>County</th>
                    <th>Region</th>
                    <th>Ward</th>
                    <th>Created By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @if (isset($datas) && count($datas) > 0)
                    @foreach ($datas as $data)
                        {{-- item --}}
                        <tr>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->start_date }}</td>
                            <td>{{ $data->start_time }}hrs</td>
                            <td>{{ $data->end_date }}</td>
                            <td>{{ $data->end_time }}hrs</td>
                            <td>{{ $data->county }}</td>
                            <td>{{ $data->regions->name }}</td>
                            <td>{{ $data->area_name }}</td>
                            <td>{{ $data->created_by_name }}</td>
                            <td class="border-none d-flex">
                                <a href="{{ url('activity-detail/' . $data->id) }}" class="ml-4">
                                    <i class="fa fa-eye text-green"></i>
                                </a> 
                                <a href="{{ url('activity-delete/' . $data->id) }}" class="ml-4">
                                    <i class="fa fa-trash text-red"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    Opps No Activity Found !!!.
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Start Date</th>
                    <th>Start Time</th>
                    <th>End Date</th>
                    <th>End Time</th>
                    <th>County</th>
                    <th>Region</th>
                    <th>Ward</th>
                    <th>Created By</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
