<div class="modal fade" id="createType">
    <div class="modal-dialog">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title text-dark">Create Type Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('type_create') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="app-auth-form text-left">
                        {{-- form item --}}
                        <div class=" mt-2">
                            <label for="" class="app-text-medium text-dark">Display Name:</label><br>
                            <input type="text" name="display_name" class="form-control" placeholder="Display Name"
                                required>
                            <div class="auth-form-msg"></div>
                        </div>
                        {{-- form item --}}
                        <div class=" mt-2">
                            <label for="" class="app-text-medium text-dark">Designation:</label><br>
                            <input type="text" name="designation" class="form-control" placeholder="Designation"
                                required>
                            <div class="auth-form-msg"></div>
                        </div>
                        {{-- form item --}}
                        <div class=" mt-2">
                            <label for="" class="app-text-medium text-dark">Description:</label><br>
                            <textarea name="description" id="" cols="20" class="form-control" required></textarea>
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
