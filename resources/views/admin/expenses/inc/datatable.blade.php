{{-- membership datatable --}}

{{-- data card --}}
<div class="card">

    {{-- heading --}}
    <div class="card-header">
        <h3 class="card-title">All Expenses</h3>
    </div>

    {{-- body --}}
    <div class="card-body">

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Expense Note</th>
                    <th>Max Cap</th>
                    <th>Created By</th>
                    <th>Updated By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @if (count($expenses) > 0)
                    @foreach ($expenses as $expense)
                        {{-- item --}}
                        <tr>
                            <td>{{ $expense->category }}</td>
                            <td>{{ $expense->sub_category }}</td>
                            <td>{{ $expense->note }}</td>
                            <td>{{ $expense->max_cap }}</td>
                            <td>{{ $expense->created_by_name }}</td>
                            <td>
                                {{-- updated by item --}}
                                @if ($expense->updated_at != $expense->created_at)
                                    {{ $expense->created_by_name }}
                                @else
                                    {{ $expense->expenseUser->first_name }} {{ $expense->expenseUser->last_name }}
                                @endif
                            </td>
                            <td class="border-none">
                                {{-- action btns --}}
                                @if ($expense->updated_at != $expense->created_at)
                                    <div class="d-flex">
                                        {{-- amend btn --}}
                                        <button class="btn sm-btn btn-warning mr-2" type="button" data-toggle="modal"
                                            data-target="#amendExpense">
                                            <span>
                                                Amend Expense
                                            </span>
                                            <span class="ml-2">
                                                <i class="fa fa-edit"></i>
                                            </span>
                                        </button>

                                        {{-- ammend modal --}}
                                        <div class="modal fade" id="amendExpense">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-primary">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title text-dark">
                                                            <h3 class="card-title">Ammend {{ $expense->category }}
                                                                Expense</h3>
                                                        </h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    {{-- amend form --}}
                                                    <form
                                                        action="{{ route('expense-update', ['type' => 'amend', 'id' => $expense->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        {{-- all requisitions --}}
                                                        <div class="card bg-yellow p-3">
                                                            {{-- note --}}
                                                            <div class="text-dark-bg-light p-2">
                                                                <div>
                                                                    <label for="">Note</label>
                                                                </div>
                                                                <small class="text-danger text-sm">
                                                                    ** EXPLAIN BRIEFLY THE NEED TO AMMEND **
                                                                </small>
                                                                <div>
                                                                    <textarea name="note" id="" cols="50" rows="5" placeholder="{{ $expense->note }}"
                                                                        value="{{ $expense->note }}" required>
                                                                            {{ $expense->note }}
                                                                        </textarea>
                                                                </div>
                                                            </div>
                                                            {{-- amount --}}
                                                            <div class="text-dark-bg-light p-2" id="note">
                                                                <div>
                                                                    <label for="">Max Cap</label>
                                                                </div>
                                                                <small class="text-danger text-sm">
                                                                    ** ADJUST MAX CAP **
                                                                </small>
                                                                <div>
                                                                    <input type="number" class="form-control"
                                                                        name="max_cap"
                                                                        placeholder="{{ $expense->max_cap }}"
                                                                        value="{{ $expense->max_cap }}" required>
                                                                </div>
                                                            </div>
                                                            {{-- btn --}}
                                                            <button class="btn btn-success m-3">
                                                                Ammend
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                                </form>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        {{-- end ammend modal --}}

                                        {{-- delete btn --}}
                                        <button class="btn sm-btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#deleteExpense">
                                            <span>
                                                Delete
                                            </span>
                                            <span class="ml-2">
                                                <i class="fas fa-trash text-white"></i>
                                            </span>
                                        </button>
                                        {{-- delete modal --}}
                                        <div class="modal fade" id="deleteExpense">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-danger">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title text-dark"> Delete Expense</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-white">
                                                            Are you sure you want to permenently delete this 
                                                            information?
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-outline-light bg-green"
                                                            data-dismiss="modal">Close</button>
                                                        <a href="{{ url('expense-delete/' . $expense->id) }}">
                                                            <button
                                                                class="btn btn-outline-light bg-warning">Delete</button>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    </div>
                                @else
                                    {{-- approve btn --}}
                                    <a href="{{ url('expense-approve/' . $expense->id) }}">
                                        <button class="btn btn-success">
                                            <span>
                                                Approve Expense
                                            </span>
                                            <span class="ml-3">
                                                <i class="fa fa-check"></i>
                                            </span>
                                        </button>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Expense Note</th>
                    <th>Max Cap</th>
                    <th>Created By</th>
                    <th>Updated By</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
