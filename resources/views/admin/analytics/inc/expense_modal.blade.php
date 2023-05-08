<div class="modal fade" id="filterExpense">
    <div class="modal-dialog">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title text-dark">
                    <h3 class="card-title">Sort Expense Data</h3>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('filterExpense') }}" method="post">
                @csrf
                {{-- filter --}}
                <div class="card bg-green p-3">
                    <h5>Filter Expense By:</h5>

                    {{-- category --}}
                    <div class="">
                        {{-- category form item --}}
                        <div class="text-dark-bg-light p-2">
                            <div>
                                <label for="">Categories</label>
                            </div>
                            <div class="row">
                                @if (isset($categories) && count($categories) > 0)
                                    @foreach ($categories as $category)
                                        <div class="col-md-4">
                                            <label for="">
                                                <input type="checkbox" name="category[]"
                                                    value="{{ $category->category }}">
                                                {{ $category->category }}
                                            </label>
                                        </div>
                                    @endforeach
                                @else
                                    Opps!! no data available
                                @endif

                            </div>
                        </div>
                    </div>

                    {{-- sub_category --}}
                    <div class="">
                        {{-- sub_category form item --}}
                        <div class="text-dark-bg-light p-2">
                            <div>
                                <label for="">Sub Categories</label>
                            </div>
                            <div class="row">
                                @if (isset($subCategories) && count($subCategories) > 0)
                                    @foreach ($subCategories as $sub_category)
                                        <div class="col-md-4">
                                            <label for="">
                                                <input type="checkbox" name="sub_category[]"
                                                    value="{{ $sub_category->sub_category }}">
                                                {{ $sub_category->sub_category }}
                                            </label>
                                        </div>
                                    @endforeach
                                @else
                                    Opps!! no data available
                                @endif

                            </div>
                        </div>
                    </div>

                    {{-- amount --}}
                    <div class="d-flex">
                        <div class="text-dark-bg-light p-2">
                            <div>
                                <label for="">Min amount</label>
                            </div>
                            <div>
                                <input type="number" class="form-control" name="min_amount">
                            </div>
                        </div>
                        <div class="text-dark-bg-light p-2">
                            <div>
                                <label for="">Max amount</label>
                            </div>
                            <div>
                                <input type="number" class="form-control" name="max_amount">
                            </div>
                        </div>
                    </div>

                    <button class="btn sm-btn btn-warning m-3" type="submit">
                        <span>
                            Filter
                        </span>
                        <span class="ml-4">
                            <i class="fa fa-search"></i>
                        </span>
                    </button>
                </div>
            </form>
        </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
