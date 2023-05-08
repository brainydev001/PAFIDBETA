<div class="modal fade" id="filterStaff">
    <div class="modal-dialog">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title text-dark">
                    <h3 class="card-title">Sort Activity Data</h3>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('filterActivity') }}" method="post">
                @csrf
                {{-- filter --}}
                <div class="card bg-green p-3">
                    <h5>Filter Activity By:</h5>
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
                                        @if ($region->region_id != null)
                                            <div class="col-md-4">
                                                <label for="">
                                                    <input type="checkbox" name="region[]"
                                                        value="{{ $region->region_id }}">
                                                    {{ $region->regions->name }}
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
                    
                    {{-- created By --}}
                    <div class="text-dark-bg-light p-2">
                        <div>
                            <label for="">Created By</label>
                        </div>
                        <div class="row">
                            @if (isset($createdBy) && count($createdBy) > 0)
                                @foreach ($createdBy as $user)
                                    <div class="col-md-4">
                                        <label for="">
                                            <input type="checkbox" name="created_by[]" value="{{ $user->created_by_name }}">
                                            {{ $user->created_by_name }}
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                    Opps!! No data found
                            @endif

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

