<div class="modal fade" id="amend">
    <div class="modal-dialog">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title text-dark">
                    <h3 class="card-title">Make Amends for {{ $type }}</h3>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('amend', [$type, $request->id]) }}" method="post">
                @csrf
                {{-- all requisitions --}}
                <div class="card bg-yellow p-3">
                    {{-- name --}}
                    <div class="text-dark-bg-light p-2">
                        <div>
                            <label for="">Requisition Name</label>
                        </div>
                        <div>
                            <input type="text" name="requsition_note" value="{{ $request->requsition_note }}" placeholder="{{ $request->requsition_note }}">
                        </div>
                    </div>

                    {{-- input amount --}}
                    <div class="text-dark-bg-light p-2">
                        <div>
                            <label for="">Estimated Amount</label>
                        </div>
                        <div>
                            <input type="number" class="form-control" name="estimated_budget" value="{{ $request->estimated_budget }}" placeholder="{{ $request->estimated_budget }}">
                        </div>
                    </div>

                    {{-- input amount --}}
                    <div class="text-dark-bg-light p-2">
                        <div>
                            <label for="">Amount</label>
                        </div>
                        <div>
                            <input type="number" class="form-control" name="amount" placeholder="{{ $request->amount }}">
                        </div>
                    </div>
                    {{-- others --}}
                    <div class="text-dark-bg-light p-2" id="note">
                        <div>
                            <label for="">Note</label>
                        </div>
                        <div>
                            <input type="text" class="form-control" name="examination_note">
                        </div>
                    </div>
                    {{-- hidden inputs --}}
                    {{-- input note --}}
                    {{-- <div class="text-dark-bg-light">
                                    <div>
                                        <label for="">Input Note</label>
                                    </div>
                                    <div>
                                        <textarea name="requsition_note" rows="3"></textarea>
                                    </div>
                                </div> --}}
                    <button class="btn btn-secondary m-3">
                        Save
                    </button>
                </div>
            </form>
        </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
