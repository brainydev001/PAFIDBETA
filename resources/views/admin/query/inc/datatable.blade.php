{{-- membership datatable --}}

{{-- data card --}}
<div class="card">

    {{-- heading --}}
    <div class="card-header">
        <h3 class="card-title">Queries</h3>
    </div>

    {{-- body --}}
    <div class="card-body">

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @if (count($queries) > 0)
                    @foreach ($queries as $query)
                        {{-- item --}}
                        <tr>
                            <td>{{ $query->name }}</td>
                            <td>{{ $query->createdBy->first_name }} {{ $query->createdBy->last_name }}</td>
                            
                            <td>{{ $query->created_at->diffForHumans() }}</td>
                            <td class="border-none">
                                <a href="{{ route('approve', [$query->id, $type]) }}">
                                    <button class="btn btn-warning">
                                        Approve
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
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
