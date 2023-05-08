{{-- user datatable --}}

@if (Auth::user()->hasRole('F.C'))
    {{-- data card --}}
    <div class="card">

        {{-- heading --}}
        <div class="card-header">
            <h3 class="card-title">Data-table showing backup activity</h3>
        </div>

        {{-- body --}}
        <div class="card-body">

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Time</th>
                        <th>Backup By</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($backups) && count($backups) > 0)
                        @foreach ($backups as $data)
                            <tr>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->date }}</td>
                                <td>{{ $data->type }}</td>
                                <td>{{ $data->createdBy}}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    @else
                        <small class="text-red">
                            No backups created. Backups are done periodically by the system or you can create a backup at any time.
                            Contact Support for technical help.
                        </small>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Time</th>
                        <th>Backup By</th>
                        <th>Details</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endif
