{{-- user datatable --}}
{{-- action btn --}}

{{-- data card --}}
<div class="card">

    {{-- heading --}}
    <div class="card-header">
        <h3 class="card-title">Data-table showing all Staff Members</h3>
    </div>

    {{-- body --}}
    <div class="card-body">

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Phone Number</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($users) && count($users) > 0)
                    @foreach ($users as $user)
                        @if ($user->first_name != 'System' && $user->last_name != 'Administrator')
                            <tr>
                                <td>
                                    <div class="demo-checkbox">
                                        <input class="select_number" form="send_to_members_form" type="checkbox"
                                            value="{{ $user->phone_number }}"
                                            data-name='{{ $user->first_name }} {{ $user->last_name }}'
                                            id="number{{ $user->id }}" name="number[]" class="chk-col-green">
                                        <label for="number{{ $user->id }}">{{ $user->phone_number }}</label>
                                    </div>
                                </td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                            </tr>
                        @endif
                    @endforeach
                @else
                    <small class="text-red">
                        {{ auth()->user()->first_name }} {{ auth()->user()->last_name }} Contact Support via <br>
                        <div class="text-green mb-3">
                            <a class="ml-0 mt-3 mb-2 font-bold text-yellow">
                                <u>Telephone Number: +254796458762 from 8:00am to 8:00pm Monday-Friday.</u>
                            </a>
                        </div>
                    </small>
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th>Phone Number</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                </tr>
            </tfoot>
        </table>
        <small class="text-red font-weight-bold">
            **Mark the checkboxes first, before clicking on the button below, to select the staff(s) to be paid. They should all be paid a similar amount**
        </small>
        <div class="m-3">
            <a href="javascript:void(0);" data-toggle="modal" data-target="#sendMembers" class="btn btn-success waves-effect">
                <span>Create PAFID To Bank email for Staff payment</span>
                <i class="fas fa-envelope ml-2"></i>
            </a>
        </div>
    </div>
    <!-- /.card-body -->
</div>

{{-- modals --}}
{{-- send to all members modal --}}
<div>
    <!-- send to all members modal -->
    <div class="modal fade" id="sendMembers" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="districtFormTitle">
                        <i class="fas fa-paper-plane" style="color:blue;"></i>
                        Request Payment From Bank For Staff Members.
                    </h4>
                </div>
                <div class="modal-body">
                    {{-- main send row --}}
                    <div class="row">
                        {{-- send form --}}
                        <div class="col-md-4 m-t-10">
                            <form id="send_to_members_form" action="{{ route('email-send') }}" method="POST">
                                @csrf
                                <div>
                                    <label for="" class="font-bold" style="color:black;">MESSAGE:</label>
                                    <textarea id="smsMessage" name="message" class="form-control" rows="5" placeholder="enter sms mesage here..."
                                        required></textarea>
                                </div>
                                <div>
                                    <label for="" class="font-bold" style="color:black;">Amount:</label>
                                    <input type="number" name="amount" class="form-control" required placeholder="Amount Payable">
                                </div>
                            </form>
                        </div>
                        {{-- CONFIRM MESSAGE --}}
                        <div class="col-md-4 m-t-10">
                            <h4 style="color:black;">Confirm Message</h4>
                            <p id="confirmText" style="background:#f5f5f5; color:black; padding:10px;"></p>
                        </div>
                        {{-- phone number and names --}}
                        <div class="col-md-4 m-t-10">
                            <h4 style="color:black;">Payment Details</h4>
                            <div id="memberDetails">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="send_to_members_form"
                        class="sms_confirm_btn btn btn-success waves-effect">
                        <span>Send Email</span>
                    </button>
                    <button id="mainHelpClose" type="button" class="btn btn-link waves-effect"
                        data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#smsMessage').keyup(function() {
        $('#confirmText').html($(this).val());
    });

    $('.select_number').change(function() {
        var details = [];
        $(".select_number").each(function() {
            if ($(this).is(":checked")) {
                details.push('<div class="p-b-10">' + $(this).val() + ' - ' + $(this).attr(
                    'data-name') + '</div>');
            }
        });
        $('#memberDetails').html(details);
    });
</script>
