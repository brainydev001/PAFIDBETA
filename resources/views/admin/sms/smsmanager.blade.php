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

        <div class="header">
            <h2>
                SMS MANAGER
            </h2>
        </div>

        {{-- overview --}}
        <div class="row">
            <div class="col-lg-3 col-6 text-dark font-weight-bold text-l">
                <a href="{{ url('dashboard/queries_table/total') }}" style="text-decoration:none;">
                    <div class="small-box bg-green hover-expand-effect" style="cursor:pointer;">
                        <div class="icon">
                            <i class="material-icons">credit_card</i>
                        </div>
                        <div class="content">
                            <div class="text">SMS BALANCE</div>
                            <div class="number">KES {{ round($airtime, 0) }}</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-6 text-dark font-weight-bold text-l">
                <a href="{{ url('dashboard/queries_table/pending') }}" style="text-decoration:none;">
                    <div class="small-box bg-green hover-expand-effect" style="cursor:pointer;">
                        <div class="icon">
                            <i class="material-icons">error</i>
                        </div>
                        <div class="content">
                            <div class="text">UNDELIVERED SMS</div>
                            <div class="number">2</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-6 text-dark font-weight-bold text-l">
                <a href="{{ url('dashboard/queries_table/tithe') }}" style="text-decoration:none;">
                    <div class="small-box bg-green hover-expand-effect" style="cursor:pointer;">
                        <div class="icon">
                            <i class="material-icons">chat_bubble</i>
                        </div>
                        <div class="content">
                            <div class="text">DELIVERED SMS</div>
                            <div class="number">2</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-6 text-dark font-weight-bold text-l">
                <a href="{{ url('dashboard/queries_table/prayer') }}" style="text-decoration:none;">
                    <div class="small-box bg-green hover-expand-effect" style="cursor:pointer;">
                        <div class="icon">
                            <i class="material-icons">cloud_upload</i>
                        </div>
                        <div class="content">
                            <div class="text">AUTOMATED SMS SENT</div>
                            <div class="number">2</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div>
            <div class="card">
                {{-- manager header/title --}}
                <div class="header">
                    <h4>SMS Manager</h4>
                    <P>Use the links below to send SMS to all members and individual members.</P>
                </div>


                {{-- main header row with helpful links --}}
                <div class="row body">
                    {{-- create blog --}}
                    <div class="col-md-4">
                        <h5>Send SMS to all members</h5>
                        <div style='max-width:50%;'>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#sendAllMembers"
                                class="btn bg-blue btn-block btn-lg waves-effect">Create SMS</a>
                        </div>
                        <div style="margin-top:10px;">
                            <a href="javascript:void(0);" class=" waves-effect waves-block" data-toggle="modal"
                                data-target="#needHelpMain">
                                <i class="far fa-question-circle" style="color:#000;"></i>
                                Need any help?
                            </a>
                        </div>
                    </div>
                    {{-- sms actions --}}
                    <div class="col-md-4">
                        <h5>SMS Actions</h5>
                        {{-- overview item --}}
                        <div style="display:flex; margin-top:10px">
                            <div>
                                <i class="fas fa-paper-plane"></i>
                            </div>
                            <div style="padding-left:10px;">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#sendGroupMembers">
                                    <span>Send SMS to County</span>
                                </a>
                            </div>
                        </div>
                        {{-- overview item --}}
                        <div style="display:flex; margin-top:10px">
                            <div>
                                <i class="fas fa-paper-plane"></i>
                            </div>
                            <div style="padding-left:10px;">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#sendDisMembers">
                                    <span>Send SMS to Sub County</span>
                                </a>
                            </div>
                        </div>
                        {{-- overview item --}}
                        <div style="display:flex; margin-top:10px">
                            <div>
                                <i class="fas fa-paper-plane"></i>
                            </div>
                            <div style="padding-left:10px;">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#sendAgeMembers">
                                    <span>Send SMS to Region</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    {{-- more actions --}}
                    <div class="col-md-4">
                        <h5>More Actions</h5>
                        {{-- action item --}}
                        <div style="display:flex; margin-top:10px">
                            <div>
                                <i class="fas fa-paper-plane"></i>
                            </div>
                            <div style="padding-left:10px;">
                                <a href="{{ url('sms_members') }}">
                                    <span>Send SMS to Member(s)</span>
                                </a>
                            </div>
                        </div>
                        {{-- action item --}}
                        <div style="display:flex; margin-top:10px">
                            <div>
                                <i class="fas fa-paper-plane"></i>
                            </div>
                            <div style="padding-left:10px;">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#sendUnregMembers">
                                    <span>Send SMS to unregistered User(s)</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- main header models --}}
                <!-- need help modal -->
                <div class="modal fade" id="needHelpMain" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="districtFormTitle">
                                    <i class="fas fa-lightbulb" style="color:blue;"></i>
                                    Helpful information
                                </h4>
                            </div>
                            <ul style="margin:20px 10px 20px 0;">
                                <li>
                                    When SMS is sent to all users it will be sent to only registered users. To send SMS
                                    to unregistered member click the relevant action below.
                                </li>
                                <li class="p-t-10">
                                    To send SMS to a specific county, sub county or region click the relevant action below.
                                </li>
                                <li class="p-t-10">
                                    To send SMS to a specific user(s) click the relevant action below
                                </li>
                            </ul>
                            <div class="modal-footer">
                                <button id="mainHelpClose" type="button" class="btn btn-link waves-effect"
                                    data-dismiss="modal">CLOSE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- modals --}}
            {{-- send to all members modal --}}
            <div>
                <!-- send to all members modal -->
                <div class="modal fade" id="sendAllMembers" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="districtFormTitle">
                                    <i class="fas fa-paper-plane" style="color:blue;"></i>
                                    Send SMS to all Users
                                </h4>
                            </div>
                            {{-- alert --}}
                            <div class="alert alert-info">
                                Make sure to confirm SMS content before sending.
                            </div>
                            {{-- confirm sms --}}
                            <div class="confirm_section" style="margin:20px; display:none;">
                                <h5 class="m-b-10">CONFIRM SMS MESSAGE</h5>
                                <p class="m-b-10" style="font-size:12px;">

                                </p>
                                <div class="m-t-10 p-b-15">
                                    <button type="button" class="edit_sms_btn btn btn-primary waves-effect">EDIT</button>
                                    <button type="submit" form="send_to_all_form"
                                        class="btn btn-success waves-effect">SEND</button>
                                </div>
                            </div>
                            {{-- form --}}
                            <div class="sms_form_container" style="margin:20px;">
                                <form id="send_to_all_form" action="{{ route('send_to_all') }}" method="POST">
                                    @csrf
                                    <div>
                                        <label for="" class="font-bold">MESSAGE:</label>
                                        <textarea name="message" class="form-control" placeholder="enter sms mesage here..." required></textarea>
                                        <input type="hidden" name="sent_by" value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="type" value="all">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="sms_confirm_btn btn btn-success waves-effect">CONFIRM
                                    SMS</button>
                                <button id="mainHelpClose" type="button" class="btn btn-link waves-effect"
                                    data-dismiss="modal">CLOSE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <!-- send to county members modal -->
                <div class="modal fade" id="sendGroupMembers" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="districtFormTitle">
                                    <i class="fas fa-paper-plane" style="color:blue;"></i>
                                    Send SMS to specific County
                                </h4>
                            </div>
                            {{-- alert --}}
                            <div class="alert alert-info">
                                Make sure to confirm SMS content before sending.
                            </div>
                            {{-- confirm sms --}}
                            <div class="confirm_section" style="margin:20px; display:none;">
                                <h5 class="m-b-10">CONFIRM SMS MESSAGE</h5>
                                <p class="m-b-10" style="font-size:12px;">

                                </p>
                                <div class="m-t-10 p-b-15">
                                    <button type="button" class="edit_sms_btn btn btn-primary waves-effect">EDIT</button>
                                    <button type="submit" form="send_to_group_form"
                                        class="btn btn-success waves-effect">SEND</button>
                                </div>
                            </div>
                            {{-- form --}}
                            <div class="sms_form_container" style="margin:20px;">
                                <form id="send_to_group_form" action="{{ route('send_to_specific') }}" method="POST">
                                    @csrf
                                    {{-- county --}}
                                    <div class="m-b-10">
                                        <label for="" class="font-bold">Counties:</label>
                                        <select name="selection" id="" class="form-control" required>
                                            <option value="">-- select county --</option>
                                            @if (count($county) > 0)
                                                @foreach ($county as $item)
                                                    <option value="{{ $item->county }}">{{ $item->county }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div>
                                        <label for="" class="font-bold">MESSAGE:</label>
                                        <textarea name="message" class="form-control" placeholder="enter sms mesage here..." required></textarea>
                                        <input type="hidden" name="sent_by" value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="type" value="county">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="sms_confirm_btn btn btn-success waves-effect">CONFIRM
                                    SMS</button>
                                <button id="mainHelpClose" type="button" class="btn btn-link waves-effect"
                                    data-dismiss="modal">CLOSE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- send to subcounty members modal --}}
            <div>
                <!-- send to subcounty members modal -->
                <div class="modal fade" id="sendDisMembers" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="districtFormTitle">
                                    <i class="fas fa-paper-plane" style="color:blue;"></i>
                                    Send SMS to Sub County
                                </h4>
                            </div>
                            {{-- alert --}}
                            <div class="alert alert-info">
                                Make sure to confirm SMS content before sending.
                            </div>
                            {{-- confirm sms --}}
                            <div class="confirm_section" style="margin:20px; display:none;">
                                <h5 class="m-b-10">CONFIRM SMS MESSAGE</h5>
                                <p class="m-b-10" style="font-size:12px;">

                                </p>
                                <div class="m-t-10 p-b-15">
                                    <button type="button" class="edit_sms_btn btn btn-primary waves-effect">EDIT</button>
                                    <button type="submit" form="send_to_dis_form"
                                        class="btn btn-success waves-effect">SEND</button>
                                </div>
                            </div>
                            {{-- form --}}
                            <div class="sms_form_container" style="margin:20px;">
                                <form id="send_to_dis_form" action="{{ route('send_to_specific') }}" method="POST">
                                    @csrf
                                    {{-- groups --}}
                                    <div class="m-b-10">
                                        <label for="" class="font-bold">Sub Counties:</label>
                                        <select name="selection" id="" class="form-control" required>
                                            <option value="">-- select sub_county --</option>
                                            @if (count($sub_county) > 0)
                                                @foreach ($sub_county as $item)
                                                    <option value="{{ $item->sub_county }}">{{ $item->sub_county }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div>
                                        <label for="" class="font-bold">MESSAGE:</label>
                                        <textarea name="message" class="form-control" placeholder="enter sms mesage here..." required></textarea>
                                        <input type="hidden" name="sent_by" value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="type" value="sub_county">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="sms_confirm_btn btn btn-success waves-effect">CONFIRM
                                    SMS</button>
                                <button id="mainHelpClose" type="button" class="btn btn-link waves-effect"
                                    data-dismiss="modal">CLOSE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- send to region members modal --}}
            <div>
                <!-- send to region members modal -->
                <div class="modal fade" id="sendAgeMembers" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="districtFormTitle">
                                    <i class="fas fa-paper-plane" style="color:blue;"></i>
                                    Send SMS to Region
                                </h4>
                            </div>
                            {{-- alert --}}
                            <div class="alert alert-info">
                                Make sure to confirm SMS content before sending.
                            </div>
                            {{-- confirm sms --}}
                            <div class="confirm_section" style="margin:20px; display:none;">
                                <h5 class="m-b-10">CONFIRM SMS MESSAGE</h5>
                                <p class="m-b-10" style="font-size:12px;">

                                </p>
                                <div class="m-t-10 p-b-15">
                                    <button type="button" class="edit_sms_btn btn btn-primary waves-effect">EDIT</button>
                                    <button type="submit" form="send_to_age_form"
                                        class="btn btn-success waves-effect">SEND</button>
                                </div>
                            </div>
                            {{-- form --}}
                            <div class="sms_form_container" style="margin:20px;">
                                <form id="send_to_age_form" action="{{ route('send_to_specific') }}" method="POST">
                                    @csrf
                                    {{-- age groups --}}
                                    <div class="m-b-10">
                                        <label for="" class="font-bold">Region:</label>
                                        <select name="selection" id="" class="form-control" required>
                                            <option value="">-- select region --</option>
                                            @if (count($region) > 0)
                                                @foreach ($region as $item)
                                                    @if ($item->region_id != null)
                                                        <option value="{{ $item->region_id }}">{{ $item->regions->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div>
                                        <label for="" class="font-bold">MESSAGE:</label>
                                        <textarea name="message" class="form-control" placeholder="enter sms mesage here..." required></textarea>
                                        <input type="hidden" name="sent_by" value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="type" value="region">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="sms_confirm_btn btn btn-success waves-effect">CONFIRM
                                    SMS</button>
                                <button id="mainHelpClose" type="button" class="btn btn-link waves-effect"
                                    data-dismiss="modal">CLOSE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- send to unregistered members modal --}}
            <div>
                <!-- send to unregistered members modal -->
                <div class="modal fade" id="sendUnregMembers" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="districtFormTitle">
                                    <i class="fas fa-paper-plane" style="color:blue;"></i>
                                    Send SMS to unregistered User(s)
                                </h4>
                            </div>
                            {{-- alert --}}
                            <div class="alert alert-info" style="font-size:12px;">
                                If you want to send to more than one number, separate the numbers with a comma (example
                                0712345678,0712345678)
                                DONT ADD SPACES BETWEEN COMMAS.
                            </div>
                            {{-- confirm sms --}}
                            <div class="confirm_section" style="margin:20px; display:none;">
                                <h5 class="m-b-10">CONFIRM SMS MESSAGE</h5>
                                <p class="m-b-10" style="font-size:12px;">

                                </p>
                                <div class="m-t-10 p-b-15">
                                    <button type="button" class="edit_sms_btn btn btn-primary waves-effect">EDIT</button>
                                    <button type="submit" form="send_to_unreg_form"
                                        class="btn btn-success waves-effect">SEND</button>
                                </div>
                            </div>
                            {{-- form --}}
                            <div class="sms_form_container" style="margin:20px;">
                                <form id="send_to_unreg_form" action="" method="POST">
                                    @csrf
                                    {{-- age groups --}}
                                    <div class="m-b-10">
                                        <label for="" class="font-bold">PHONE NUMBER(S):</label>
                                        <input type="text" class="form-control" name="number"
                                            placeholder="0712345678,0712345678" required>
                                    </div>
                                    <div>
                                        <label for="" class="font-bold">MESSAGE:</label>
                                        <textarea name="message" class="form-control" placeholder="enter sms mesage here..." required></textarea>
                                        <input type="hidden" name="sent_by" value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="type" value="unreg">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="sms_confirm_btn btn btn-success waves-effect">CONFIRM
                                    SMS</button>
                                <button id="mainHelpClose" type="button" class="btn btn-link waves-effect"
                                    data-dismiss="modal">CLOSE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <script>
        // sms confirmation script 
        $('.sms_confirm_btn').click(function() {
            var content = $(this).parent().parent().find('.sms_form_container').find('textarea').val();
            $(this).parent().parent().find('.sms_form_container').hide();
            $(this).parent().parent().find('.confirm_section').show().find('p').html(content);
            $(this).parent().parent().find('.modal-footer').hide();
        });

        $('.edit_sms_btn').click(function() {
            $(this).parent().parent().parent().find('.confirm_section').hide();
            $(this).parent().parent().parent().find('.sms_form_container').show();
            $(this).parent().parent().parent().find('.modal-footer').show();
        });
    </script>
@endsection
