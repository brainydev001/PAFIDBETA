@if (Auth::user()->hasRole('F.C'))
    {{-- data card --}}
    <div class="card">

        {{-- heading --}}
        <div class="card-header">
            <h3 class="card-title">Data-table showing all farmer activity</h3>
        </div>

        {{-- body --}}
        <div class="card-body">

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-yellow">
                        <th>Farmer Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($farmers) && count($farmers) > 0)
                        @foreach ($farmers as $farmer)
                            <tr>
                                <form action="{{ route('store-attendance', ['type' => 'FC', 'id' => $id]) }}"
                                    method="post">
                                    @csrf
                                    <td>
                                        <label for="">User Name</label>
                                        <input type="text" name="member_name" class="form-control"
                                            value="{{ $farmer->first_name }} {{ $farmer->last_name }}"
                                            placeholder="{{ $farmer->first_name }} {{ $farmer->last_name }}">
                                    </td>
                                    @php
                                       $check =  $farmer->attendance()->where('activity_id',$id)->first();
                                    @endphp
                                    <td>
                                        @if ($check)
                                            <button>
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <input type="hidden" value=" {{ $farmer->id }} " name="user_id">
                                        @else
                                            <button class="mt-4 p-2 btn btn-success">
                                                <span>Mark As Attended</span>
                                            </button>
                                            <input type="hidden" value=" {{ $farmer->id }} " name="user_id">
                                        @endif
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    @else
                        <small class="text-red">
                            {{ auth()->user()->first_name }} {{ auth()->user()->last_name }} you have not created
                            any
                            Farmer in this area using this MIS platform.
                            This might affect your timeley performance index analysis. Click on the HELP button or
                            contact
                            Pafid System Support on, <br>
                            <div class="text-green mb-3">
                                <a class="ml-0 mt-3 mb-2 font-bold text-yellow">
                                    <u>Telephone Number: +254796458762 from 8:00am to 8:00pm Monday-Friday.</u>
                                </a>
                            </div>
                        </small>
                    @endif
                </tbody>
                <tfoot>
                    <tr class="text-yellow">
                        <th>Farmer Name</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endif
