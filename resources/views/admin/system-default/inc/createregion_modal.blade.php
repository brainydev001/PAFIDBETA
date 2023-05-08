<div class="modal fade" id="createRegion">
    <div class="modal-dialog">
        <div class="modal-content bg-warning">
            <div class="modal-header">
                <h4 class="modal-title text-dark">Create {{ $type }} Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('region_create', $type)}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="app-auth-form text-left">
                        {{-- form item --}}
                        <div class=" mt-2">
                            <label for="" class="app-text-medium text-dark">{{ $type }} Name:</label><br>
                            <input type="text" name="name" class="form-control" placeholder="{{ $type }} Name"
                                required>
                            <div class="auth-form-msg"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light bg-red" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-light bg-green">Create</button>
                </div>
        </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
