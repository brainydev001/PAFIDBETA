<div class="modal fade" id="filterFarmer">
    <div class="modal-dialog">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title text-dark">
                    <h3 class="card-title">Sort Farmer Data</h3>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('filterFarmer') }}" method="post">
                @csrf
                {{-- filter --}}
                <div class="card bg-green p-3">
                    <h5>Filter Farmer By:</h5>

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
                                                    <input type="checkbox" name="county[]"
                                                        value="{{ $county->county }}">
                                                    {{ $county->county }}
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    Opps!! no record found
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
                                    Opps!! no record found
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
                                    Opps!! no record found
                                @endif

                            </div>
                        </div>
                    </div>

                    {{-- Age --}}
                    <div class="text-dark-bg-light p-2">
                        <div>
                            <label for="">Age Groups</label>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">
                                    <input type="checkbox" name="age[]" value="Under 35">
                                    Under 35
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label for="">
                                    <input type="checkbox" name="age[]" value="Between 35 - 60">
                                    Between 35 - 60
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label for="">
                                    <input type="checkbox" name="age[]" value="Above 60">
                                    Above 60
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- Gender --}}
                    <div class="text-dark-bg-light p-2">
                        <div>
                            <label for="">Genders</label>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">
                                    <input type="checkbox" name="gender[]" value="Male">
                                    Male
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label for="">
                                    <input type="checkbox" name="gender[]" value="Female">
                                    Female
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- farmer type --}}
                    <div class="text-dark-bg-light p-2">
                        <div>
                            <label for="">Farmer Type</label>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">
                                    <input type="checkbox" name="type[]" value="Under Training">
                                    Under Training
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label for="">
                                    <input type="checkbox" name="type[]" value="Adopter Farmer">
                                    Adopter Farmer
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- Disability Type --}}
                    <div class="">
                        {{-- form item --}}
                        <div class="text-dark-bg-light p-2">
                            <div>
                                <label for="">Disability Type</label>
                            </div>
                            <div class="row">
                                @if (isset($dTypes) && count($dTypes) > 0)
                                    @foreach ($dTypes as $dType)
                                        <div class="col-md-4">
                                            <label for="">
                                                <input type="checkbox" name="disability_name[]" value="{{ $dType->disability_name }}">
                                                {{ $dType->disability_name }}
                                            </label>
                                        </div>
                                    @endforeach
                                @else
                                    Opps!! no record found
                                @endif

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
