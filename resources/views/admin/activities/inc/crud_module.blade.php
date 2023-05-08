{{-- check for type and determine the form method and route --}}


<form action="{{ route('activity-store') }}" method="post">
    @csrf
    <!-- Main content for events and activities-->
    <section class="content m-3">
        <div class="row">
            <div class="col-md-6">
                {{-- project details --}}
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">General Information</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- name --}}
                        <div class="form-group">
                            <label for="inputName">Activity Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        {{-- description --}}
                        <div class="form-group">
                            <label for="inputDescription">Description</label>
                            <textarea name="description" class="form-control" required rows="4"></textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>

                {{-- timeline details --}}
                <div class="card card-warning">
                    {{-- project timeline --}}
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Activity Timeline</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                    data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- start date --}}
                            <div class="form-group">
                                <label for="inputEstimatedBudget">Start Date & Time</label>
                                <input type="datetime-local" name="start_date" class="form-control" required>
                            </div>

                            {{-- end date --}}
                            <div class="form-group">
                                <label for="inputEstimatedBudget">End Date & Time</label>
                                <input type="datetime-local" name="end_date" class="form-control" required>
                            </div>
                        </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card-body -->
                </div>

                <!-- /.card -->
            </div>

            {{-- project location --}}
            {{-- location card --}}
            <div class="card card-warning col-md-6 ">
                <div class="card-header">
                    <h3 class="card-title">Activity Location</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                            <i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    {{-- county --}}
                    <div class="form-group">
                        <label for="inputDescription">County</label>
                        <select name="county"
                            class="form-control select-county @error('county') form-invalid @enderror"
                            value="{{ old('county') }}">
                            <option value="" disabled selected>Select county</option>
                        </select>
                    </div>

                    {{-- sub-county --}}
                    <div class="form-group">
                        <label for="inputDescription">Sub County</label>
                        <select name="sub_county"
                            class="form-control select-subcounty @error('sub_county') form-invalid @enderror"
                            value="{{ old('sub_county') }}" required>
                            <option value="" disabled selected>Select subcounty</option>
                        </select>
                    </div>

                    {{-- region --}}
                    <div class="form-group">
                        <label for="inputDescription">Region</label>
                        <select name="region_id"
                            class="form-control region_id @error('region_id') form-invalid @enderror"
                            value="{{ old('region_id') }}" required>
                            <option value="" disabled selected>Select region</option>
                            @if (isset($regions) && count($regions) > 0)
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            @else
                                <option value="" disabled selected>Select region</option>
                            @endif
                        </select> 
                    </div>

                    {{-- area --}}
                    <div class="form-group">
                            <label for="inputDescription">Area Name</label>
                            <input type="text" name="area_name" class="form-control" required>
                        </div>
                </div>
                <!-- /.card-body -->
            </div>
            
            <!-- /.card -->
        </div>
        <div class="row text-center mb-2">
            <div class="col-12">
                <input type="submit" value="Create Activity" class="btn btn-success p-2">
            </div>
        </div>
    </section>
    <!-- /.content -->
</form>

</div>
{{-- <div class="text-right">
    <button class="btn btn-warning" type="submit">
        Submit
    </button>
</div> --}}
</div>
</div>
</div>
<!-- /.card -->
</div>
<!-- /.card -->
</form>
</div>
</div>
</div>
</div>
</div>
<!-- /.card-body -->
</div>

</section>
<!-- /.content -->
<!-- /.content-wrapper -->


<!-- /.content-wrapper -->
