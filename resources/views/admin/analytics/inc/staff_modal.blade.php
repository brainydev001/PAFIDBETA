<div class="modal fade" id="filterStaff">
    <div class="modal-dialog">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title text-dark">
                    <h3 class="card-title">Sort Staff Data</h3>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('filterStaff') }}" method="post">
                @csrf
                {{-- filter --}}
                <div class="card bg-green p-3">
                    <h5>Filter Staff By:</h5>
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
                                @endif

                            </div>
                        </div>
                    </div>

                    {{-- age --}}
                    <div class="d-flex">
                        <div class="text-dark-bg-light p-2">
                            <div>
                                <label for="">Min age</label>
                            </div>
                            <div>
                                <input type="number" class="form-control" name="min_age">
                            </div>
                        </div>
                        <div class="text-dark-bg-light p-2">
                            <div>
                                <label for="">Max age</label>
                            </div>
                            <div>
                                <input type="number" class="form-control" name="max_age">
                            </div>
                        </div>
                    </div>
                    {{-- role --}}
                    <div class="text-dark-bg-light p-2">
                        <div>
                            <label for="">Role</label>
                        </div>
                        <div class="row">
                            @if (isset($roles) && count($roles) > 0)
                                @foreach ($roles as $role)
                                    <div class="col-md-4">
                                        <label for="">
                                            <input type="checkbox" name="roles[]" value="{{ $role->role_id }}">
                                            {{ $role->roleUser->display_name }}
                                        </label>
                                    </div>
                                @endforeach
                            @else
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

