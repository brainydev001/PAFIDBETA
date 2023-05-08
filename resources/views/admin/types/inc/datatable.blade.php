{{-- membership datatable --}}

{{-- data card --}}
<div class="card">

    {{-- heading --}}
    <div class="card-header">
        <h3 class="card-title">Data-table showing all membership types</h3>
    </div>

    {{-- body --}}
    <div class="card-body">

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Display Name</th>
                    <th>Designation</th>
                    <th>Description</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @if (count($types) > 0)
                    @foreach ($types as $type)
                        {{-- item --}}
                        <tr>
                            <td>{{ $type->display_name }}</td>
                            <td>{{ $type->designation }}</td>
                            <td>
                                <p>
                                    {{ $type->description }}
                                </p>
                            </td>
                            <td>{{ $type->createdBy->first_name }}</td>
                            <td>{{ $type->created_at->diffForHumans() }}</td>
                            <td class="border-none">
                                <a href="{{ url('type_delete/'.$type->id) }}" class="ml-4">
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
                    <th>Display Name</th>
                    <th>Designation</th>
                    <th>Description</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
