<div class="modal fade" id="requisition">
    <div class="modal-dialog">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title text-dark">
                    <h3 class="card-title">Make Requisitions for {{ $type }}</h3>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('budget_store', [$type, $id]) }}" method="post">
                @csrf
                {{-- all requisitions --}}
                <div class="card bg-yellow p-3">
                    {{-- name --}}
                    <div class="text-dark-bg-light p-2">
                        <div>
                            <label for="">Requisition Name</label>
                        </div>
                        <div>
                            <select name="requsition_note" class="form-control">
                                @if (count($expenses) > 0 )
                                    @foreach ($expenses as $expense)
                                        <option value="{{ $expense->amount }},{{ $expense->name }}" id="name">{{ $expense->name }}</option>
                                    @endforeach    
                                @else
                                    <option value=""></option>
                                @endif
                            </select>
                        </div>
                    </div>

                    {{-- input amount --}}
                    <div class="text-dark-bg-light p-2">
                        <div>
                            <label for="">Estimated Amount</label>
                        </div>
                        <div>
                            <div class="text-sm text-red" id="err">

                            </div>
                            <input type="number" class="form-control" name="estimated_amount" id="requestAmount">
                        </div>
                    </div>

                    {{-- input amount --}}
                    <div class="text-dark-bg-light p-2">
                        <div>
                            <label for="">Amount</label>
                        </div>
                        <div>
                            <input type="number" class="form-control" name="amount">
                        </div>
                    </div>
                    {{-- others --}}
                    <div class="text-dark-bg-light p-2" style=" display:none;" id="note">
                        <div>
                            <label for="">Note</label>
                        </div>
                        <div>
                            <input type="text" class="form-control" name="note">
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


<script>
    document.getElementById('requestAmount').onblur = function() {
        var requestAmount = this.value
        var amount = document.getElementById("name").value;
        if (requestAmount > amount) {
            var err = document.getElementById("err")
            err.innerHTML = 'Price cannot be higher than set amount'
            document.getElementById("note").style.display = "inline"

        } else {
            var err = document.getElementById("err")
            err.innerHTML = 'Price within set amount'
            document.getElementById("note").style.display = "none"
        }
    }
</script>
