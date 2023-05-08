{{-- activity or event or module datatable --}}

{{-- data card --}}
<div class="card">

    {{-- heading --}}
    <div class="card-header">
        <h3 class="card-title">Data-table</h3>
    </div>

    {{-- body --}}
    <div class="card-body">

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Expense Name</th>
                    <th>Amount on Reciept</th>
                    <th>Payment Evidence</th>
                    <th>Action</th>
                </tr>
            </thead>
            <form action="{{ route('upload_payment') }}" method="post" enctype="multipart/form-data">
                @csrf
                <tbody>
                    <tr>
                        <td>
                            <select name="name" id="" class="form-control">
                                @if (count($activity) > 0)
                                    @foreach ($activity as $item)
                                        <option value="{{ $item->activities->name }}" class="form-control">
                                            {{ $item->activities->name }}</option>
                                    @endforeach
                                @else
                                    No approved requisition
                                @endif
                            </select>
                        </td>
                        <td>
                            <input type="number" name="amount" class="form-control" required>
                        </td>
                        <td>
                            <input type="file" name="photo" required>
                        </td>
                        <td>
                            <button class="btn sm-btn btn-warning">
                                Upload
                            </button>
                        </td>
                    </tr>
                </tbody>
            </form>
            <tfoot>
                <tr>
                    <th>Expense Name</th>
                    <th>Amount on Reciept</th>
                    <th>Payment Evidence</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
