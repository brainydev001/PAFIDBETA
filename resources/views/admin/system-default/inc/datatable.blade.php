{{-- Region datatable --}}

{{-- data card --}}
<div class="card">

    {{-- heading --}}
    <div class="card-header">
        <h3 class="card-title">Data-table showing all {{ $type }}</h3>
    </div>

    {{-- body --}}
    <div class="card-body">

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>{{ $type }} Name</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @if (count($datas) > 0)
                    @foreach ($datas as $data)
                        {{-- item --}}
                        <tr>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->createdBy->first_name }}</td>
                            <td>{{ $data->created_at->diffForHumans() }}</td>
                            <td class="border-none">
                                <a href="{{ url('region_delete/'.$data->id.'/'.$data->type) }}" class="ml-4">
                                    <i class="fa fa-trash text-red"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th>{{ $type }} Name</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
