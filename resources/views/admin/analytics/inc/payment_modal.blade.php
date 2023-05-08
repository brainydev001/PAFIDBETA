{{-- receipt --}}
<div class="modal fade" id="filterReceipt">
    <div class="modal-dialog">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title text-dark">
                    <h3 class="card-title">Sort Receipt Data</h3>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('filterPayment', ['type' => 'Receipt']) }}" method="post">
                @csrf
                {{-- filter --}}
                <div class="card bg-green p-3">
                    <h5>Filter Receipt By:</h5>

                    {{-- county --}}
                    <div class="">
                        {{-- county form item --}}
                        <div class="text-dark-bg-light p-2">
                            <div>
                                <label for="">Counties</label>
                            </div>
                            <div class="row">
                                @if (isset($Rcounties) && count($Rcounties) > 0)
                                    @foreach ($Rcounties as $county)
                                        <div class="col-md-4">
                                            <label for="">
                                                <input type="checkbox" name="county[]" value="{{ $county }}">
                                                {{ $county }}
                                            </label>
                                        </div>
                                    @endforeach
                                @else
                                        Opps!! No recorded data
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
                                @if (isset($Rsub_counties) && count($Rsub_counties) > 0)
                                    @foreach ($Rsub_counties as $sub_county)
                                            <div class="col-md-4">
                                                <label for="">
                                                    <input type="checkbox" name="sub_county[]"
                                                        value="{{ $sub_county}}">
                                                    {{ $sub_county}}
                                                </label>
                                            </div>
                                    @endforeach
                                @else
                                            Opps!! No recorded data
                                @endif

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
                                @if (isset($Rregions) && count($Rregions) > 0)
                                    @foreach ($Rregions as $region)
                                            <div class="col-md-4">
                                                <label for="">
                                                    <input type="checkbox" name="region[]"
                                                        value="{{ $region }}">
                                                    {{ $region }}
                                                </label>
                                            </div>
                                    @endforeach
                                @else
                                            Opps!! No recorded data
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

                    {{-- category --}}
                    <div class="text-dark-bg-light p-2">
                        <div>
                            <label for="">Category</label>
                        </div>
                        <div class="row">
                            @if (isset($Rcategory) && count($Rcategory) > 0)
                                @foreach ($Rcategory as $category)
                                    <div class="col-md-4">
                                        <label for="">
                                            <input type="checkbox" name="categorys[]" value="{{ $category->category }}">
                                            {{ $category->category }}
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                    Opps!! No recorded data
                            @endif

                        </div>
                    </div>

                    {{-- sub category --}}
                    <div class="text-dark-bg-light p-2">
                        <div>
                            <label for="">Sub Category</label>
                        </div>
                        <div class="row">
                            @if (isset($Rsub_category) && count($Rsub_category) > 0)
                                @foreach ($Rsub_category as $sub_category)
                                    <div class="col-md-4">
                                        <label for="">
                                            <input type="checkbox" name="sub_categorys[]" value="{{ $sub_category->sub_category }}">
                                            {{ $sub_category->sub_category }}
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                    Opps!! No recorded data
                            @endif

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

{{-- budget --}}
<div class="modal fade" id="filterBudget">
    <div class="modal-dialog">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title text-dark">
                    <h3 class="card-title">Sort Budget Data</h3>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('filterPayment', ['type' => 'Budget']) }}" method="post">
                @csrf
                {{-- filter --}}
                <div class="card bg-green p-3">
                    <h5>Filter Budget By:</h5>

                    {{-- county --}}
                    <div class="">
                        {{-- county form item --}}
                        <div class="text-dark-bg-light p-2">
                            <div>
                                <label for="">Counties</label>
                            </div>
                            <div class="row">
                                @if (isset($Bcounties) && count($Bcounties) > 0)
                                    @foreach ($Bcounties as $county)
                                        <div class="col-md-4">
                                            <label for="">
                                                <input type="checkbox" name="county[]" value="{{ $county }}">
                                                {{ $county }}
                                            </label>
                                        </div>
                                    @endforeach
                                @else
                                        Opps!! No recorded data
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
                                @if (isset($Bsub_counties) && count($Bsub_counties) > 0)
                                    @foreach ($Bsub_counties as $sub_county)
                                            <div class="col-md-4">
                                                <label for="">
                                                    <input type="checkbox" name="sub_county[]"
                                                        value="{{ $sub_county }}">
                                                    {{ $sub_county }}
                                                </label>
                                            </div>
                                    @endforeach
                                @else
                                            Opps!! No recorded data
                                @endif

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
                                @if (isset($Bregions) && count($Bregions) > 0)
                                    @foreach ($Bregions as $region)
                                            <div class="col-md-4">
                                                <label for="">
                                                    <input type="checkbox" name="region[]"
                                                        value="{{ $region}}">
                                                    {{ $region }}
                                                </label>
                                            </div>
                                    @endforeach
                                @else
                                            Opps!! No recorded data
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
                    {{-- category --}}
                    <div class="text-dark-bg-light p-2">
                        <div>
                            <label for="">Category</label>
                        </div>
                        <div class="row">
                            @if (isset($Bcategory) && count($Bcategory) > 0)
                                @foreach ($Bcategory as $category)
                                    <div class="col-md-4">
                                        <label for="">
                                            <input type="checkbox" name="categorys[]" value="{{ $category->category }}">
                                            {{ $category->category }}
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                    Opps!! No recorded data
                            @endif

                        </div>
                    </div>

                    {{-- sub category --}}
                    <div class="text-dark-bg-light p-2">
                        <div>
                            <label for="">Sub Category</label>
                        </div>
                        <div class="row">
                            @if (isset($Bdatas) && count($Bdatas) > 0)
                                @foreach ($Bdatas as $sub_category)
                                    <div class="col-md-4">
                                        <label for="">
                                            <input type="checkbox" name="sub_categorys[]" value="{{ $sub_category->sub_category }}">
                                            {{ $sub_category->sub_category }}
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                    Opps!! No recorded data
                            @endif

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


{{-- invoice --}}
<div class="modal fade" id="filterInvoice">
    <div class="modal-dialog">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title text-dark">
                    <h3 class="card-title">Sort Invoice Data</h3>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('filterPayment', ['type' => 'Invoice']) }}" method="post">
                @csrf
                {{-- filter --}}
                <div class="card bg-green p-3">
                    <h5>Filter Invoice By:</h5>

                    {{-- county --}}
                    <div class="">
                        {{-- county form item --}}
                        <div class="text-dark-bg-light p-2">
                            <div>
                                <label for="">Counties</label>
                            </div>
                            <div class="row">
                                @if (isset($Icounties) && count($Icounties) > 0)
                                    @foreach ($Icounties as $county)
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
                                        Opps!! No recorded data
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
                                @if (isset($Isub_counties) && count($Isub_counties) > 0)
                                    @foreach ($Isub_counties as $sub_county)
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
                                            Opps!! No recorded data
                                @endif

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
                                @if (isset($Iregions) && count($Iregions) > 0)
                                    @foreach ($Iregions as $region)
                                        @if ($region->region_name != null)
                                            <div class="col-md-4">
                                                <label for="">
                                                    <input type="checkbox" name="region_name[]"
                                                        value="{{ $region->region_name }}">
                                                    {{ $region->region_name }}
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                            Opps!! No recorded data
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
                    {{-- category --}}
                    <div class="text-dark-bg-light p-2">
                        <div>
                            <label for="">Category</label>
                        </div>
                        <div class="row">
                            @if (isset($Icategory) && count($Icategory) > 0)
                                @foreach ($Icategory as $category)
                                    <div class="col-md-4">
                                        <label for="">
                                            <input type="checkbox" name="category[]" value="{{ $category->category }}">
                                            {{ $category->category }}
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                    Opps!! No recorded data
                            @endif

                        </div>
                    </div>

                    {{-- sub category --}}
                    {{-- <div class="text-dark-bg-light p-2">
                        <div>
                            <label for="">Sub Category</label>
                        </div>
                        <div class="row">
                            @if (isset($Isub_category) && count($Isub_category) > 0)
                                @foreach ($Isub_category as $sub_category)
                                    <div class="col-md-4">
                                        <label for="">
                                            <input type="checkbox" name="sub_categorys[]" value="{{ $sub_category->sub_category }}">
                                            {{ $sub_category->sub_category }}
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                    Opps!! No recorded data
                            @endif

                        </div>
                    </div> --}}

                    


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
