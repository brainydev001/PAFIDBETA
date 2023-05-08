{{-- role/permission datatable --}}

{{-- data card --}}
<div class="card">

    {{-- heading --}}
    <div class="card-header">
        <h3 class="card-title">Data-table showing all {{ ucfirst($origin) }}</h3>
    </div>

    {{-- body --}}
    <div class="card-body">

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Display Name</th>
                    <th>Description</th>
                    <th>Created At</th>
                    @if ($origin == 'roles')
                        <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>

                @if (count($types) > 0)
                    @foreach ($types as $type)
                        {{-- item --}}
                        <tr>
                            <td>{{ $type->name }}</td>
                            <td>{{ $type->display_name }}</td>
                            <td>
                                <p>
                                    {{ $type->description }}
                                </p>
                            </td>
                            <td>{{ $type->created_at->diffForHumans() }}</td>
                            @if ($origin == 'roles')
                                <td class="border-none">
                                    <a href="{{ url('type_delete/' . $type->id) }}" class="ml-4">
                                        <i class="fa fa-trash text-red"></i>
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @else
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Display Name</th>
                    <th>Description</th>
                    <th>Created At</th>
                    @if ($origin == 'roles')
                        <th>Action</th>
                    @endif
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
