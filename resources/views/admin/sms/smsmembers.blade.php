@extends('layouts.admin')

@section('page')

    {{-- include top nav --}}
    @include('admin.inc.admin_top_nav')

    {{-- include side nav --}}
    @include('admin.inc.admin_side_nav')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        {{-- breadcrumbs --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard_index">Dashboard</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        {{-- include alert messages --}}
        @include('alerts.messages')

        <div class="block-header">
            <h2>
                SEND SMS TO MEMBER(S)
            </h2>
        </div>

        <ol class="breadcrumb breadcrumb-col-cyan">
            <li><a href="{{ url('sms_manager') }}">SMS Manager</a></li>
            <li class="active">Send SMS to specific member(s)</li>
        </ol>

        {{-- alert --}}
        <div class="alert alert-info">
            <strong>
                <i class="fas fa-info-circle"></i>
                IMPORTANT INFO!
            </strong>
            Use the table below to search registered members. You can select a single or many member(s). After making
            selections click create SMS to write and send SMS.
        </div>

        {{-- action btn --}}
        <div class="align-right p-b-15">
            <a href="javascript:void(0);" data-toggle="modal" data-target="#sendMembers"
                class="btn btn-success waves-effect">
                <i class="material-icons">mail</i>
                <span>CREATE SMS</span>
            </a>
        </div>

        <div class="card">
            <div class="row body">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Phone Number</th>
                            <th>Name</th>
                            <th>County</th>
                            <th>Sub County</th>
                            <th>Region</th>
                            <th>View Member</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Phone Number</th>
                            <th>Name</th>
                            <th>County</th>
                            <th>Sub County</th>
                            <th>Region</th>
                            <th>View Member</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if (count($users) > 0)
                            @foreach ($users as $item)
                                <tr>
                                    <td>
                                        <div class="demo-checkbox">
                                            <input class="select_number" form="send_to_members_form" type="checkbox"
                                                value="{{ $item->phone_number }}"
                                                data-name='{{ $item->first_name }} {{ $item->last_name }}'
                                                id="number{{ $item->id }}" name="number[]" class="chk-col-green">
                                            <label for="number{{ $item->id }}">{{ $item->phone_number }}</label>
                                        </div>
                                    </td>
                                    <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                                    <td>{{ $item->county }}</td>
                                    <td>{{ $item->sub_county }}</td>
                                    <td>
                                        @if ($item->region_id != null)
                                            {{ $item->regions->name }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('user-view/User') }}/{{ $item->id }}"
                                            class="btn bg-indigo waves-effect">
                                            <i class="material-icons">visibility</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
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
                                Create SMS message to send to selected member(s)
                            </h4>
                        </div>
                        <div class="modal-body">
                            {{-- main send row --}}
                            <div class="row">
                                {{-- send form --}}
                                <div class="col-md-4 m-t-10">
                                    <form id="send_to_members_form" action="{{ route('send_to_specific') }}"
                                        method="POST">
                                        @csrf
                                        <div>
                                            <label for="" class="font-bold" style="color:black;">MESSAGE:</label>
                                            <textarea id="smsMessage" name="message" class="form-control" rows="5" placeholder="enter sms mesage here..."
                                                required></textarea>
                                            <input type="hidden" name="sent_by" value="{{ auth()->user()->id }}">
                                            <input type="hidden" name="type" value="members">
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
                                    <h4 style="color:black;">Member(s) Details</h4>
                                    <div id="memberDetails">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" form="send_to_members_form"
                                class="sms_confirm_btn btn btn-success waves-effect">
                                <i class="material-icons">send</i>
                                <span>SEND SMS</span>
                            </button>
                            <button id="mainHelpClose" type="button" class="btn btn-link waves-effect"
                                data-dismiss="modal">CLOSE</button>
                        </div>
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


@endsection
