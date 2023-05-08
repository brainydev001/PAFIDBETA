<div class="modal fade" id="filterRequisition">
    <div class="modal-dialog">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title text-dark">
                    <h3 class="card-title">Sort Requisition Data</h3>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('filterRequisition') }}" method="post">
                @csrf
                {{-- filter --}}
                <div class="card bg-green p-3">
                    <h5>Filter Requisition By:</h5>
                    {{-- county --}}
                    <div class="">
                        {{-- county form item --}}
                        <div class="text-dark-bg-light p-2">
                            <div>
                                <label for="">Counties</label>
                            </div>
                            <div class="row">
                                @if (isset($counties) && count($counties) > 0)
                                    @foreach ($counties as $county)
                                        @if ($county->county != null)
                                        <div class="col-md-4">
                                            <label for="">
                                                <input type="checkbox" name="county[]" value="{{ $county->county }}">
                                                {{ $county->county }}
                                            </label>
                                        </div>
                                        @endif
                                    @endforeach
                                @else
                                        Opps!! No data found
                                @endif

                            </div>
                        </div>
                    </div>

                    {{-- sub county --}}
                    <div class="">
                        {{-- form item  --}}
                        <div class="text-dark-bg-light p-2">
                            <div>
                                <label for="">Sub Counties</label>
                            </div>
                            <div class="row">
                                @if (isset($sub_counties) && count($sub_counties) > 0)
                                    @foreach ($sub_counties as $sub_county)
                                        @if ($sub_county->sub_county != null)
                                            <div class="col-md-4">
                                                <label for="">
                                                    <input type="checkbox" name="sub_county[]"
                                                        value="{{ $sub_county->sub_county }}">
                                                    {{ $sub_county->sub_county }}
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                            Opps!! No data found
                                @endif

                            </div>
                        </div>
                    </div>

                    {{-- category --}}
                    <div class="">
                        {{-- form item  --}}
                        <div class="text-dark-bg-light p-2">
                            <div>
                                <label for="">Expense Categories</label>
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
                                            Opps!! No data found
                                @endif

                            </div>
                        </div>
                    </div>

                    {{--sub category --}}
                    <div class="">
                        {{-- form item  --}}
                        <div class="text-dark-bg-light p-2">
                            <div>
                                <label for="">Expense Sub Categories</label>
                            </div>
                            <div class="row">
                                @if (isset($sub_categories) && count($sub_categories) > 0)
                                    @foreach ($sub_categories as $sub_category)
                                            <div class="col-md-4">
                                                <label for="">
                                                    <input type="checkbox" name="sub_category[]"
                                                        value="{{ $sub_category->sub_category }}">
                                                    {{ $sub_category->sub_category }}
                                                </label>
                                            </div>
                                    @endforeach
                                @else
                                            Opps!! No data found
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

                    {{-- regions --}}
                    <div class="">
                        {{-- form item --}}
                        <div class="text-dark-bg-light p-2">
                            <div>
                                <label for="">Regions</label>
                            </div>
                            <div class="row">
                                @if (isset($regions) && count($regions) > 0)
                                    @foreach ($regions as $region)
                                            <div class="col-md-4">
                                                <label for="">
                                                    <input type="checkbox" name="region[]"
                                                        value="{{ $region->region_name }}">
                                                    {{ $region->region_name }}
                                                </label>
                                            </div>
                                    @endforeach
                                @else
                                            Opps!! No data found
                                @endif

                            </div>
                        </div>
                    </div>

                    {{-- date --}}
                    <div class="d-flex" class="w-50">
                        <div class="text-dark-bg-light p-2">
                            <div>
                                <label for="">Start Date</label>
                            </div>
                            <div>
                                <input type="date" class="form-control" name="start_date" required>
                            </div>
                        </div>
                        <div class="text-dark-bg-light p-2">
                            <div>
                                <label for="">End Date</label>
                            </div>
                            <div>
                                <input type="date" class="form-control" name="end_date" required>
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

