<div class="modal fade" id="filter">
    <div class="modal-dialog">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title text-dark">
                    <h3 class="card-title">Sort By Date</h3>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('log_filter') }}" method="post">
                @csrf
                {{-- filter --}}
                <div class="card bg-green p-3">
                    {{-- start date --}}
                    <div class="text-dark-bg-light p-2">
                        <div>
                            <label for="">Start Date</label>
                        </div>
                        <div>
                            <input type="datetime-local" class="form-control" name="start_date"  placeholder="Start Date">
                        </div>
                    </div>

                    {{-- end date --}}
                    <div class="text-dark-bg-light p-2">
                        <div>
                            <label for="">End Date</label>
                        </div>
                        <div>
                            <input type="datetime-local" class="form-control"  name="end_date"  placeholder="End Date">
                        </div>
                    </div>
                    <button class="btn sm-btn btn-warning m-3">
                        <span>
                            Search
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