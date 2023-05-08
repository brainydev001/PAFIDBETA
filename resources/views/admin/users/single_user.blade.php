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
                <div class="row mb-2 justify-items-center">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }} Manager
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        {{-- include alert messages --}}
        @include('alerts.messages')

        {{-- verify user --}}
        @if ($type == 'User' && $user->is_approved == true)
            {{-- deactivate --}}
            <div class="btn-group mt-2 mb-2 mb-col-4">
                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                    <span class="p-2">
                        <i class="fas fa-cogs"></i>
                    </span>
                    <span class="p-2">
                        Actions
                    </span>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ url('approve/Deactivate/' . $user->id) }}">
                        <span class="p-2">
                            <i class="fas fa-ban text-danger"></i>
                        </span>
                        <span>
                            De-activate
                        </span>
                    </a>
                    <a class="dropdown-item" href="{{ url('user-action/archive/' . $user->id) }}">
                        <span class="p-2">
                            <i class="fas fa-briefcase text-secondary"></i>
                        </span>
                        <span>
                            Archive
                        </span>
                    </a>

                    {{-- delete user btn & modal --}}
                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#deleteUser">
                        <span class="p-2">
                            <i class="fas fa-trash text-red"></i>
                        </span>
                        <span>
                            Delete
                        </span>
                    </button>
                    
                    {{-- end delete user modal --}}

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-green" href="#">Request Help</a>
                </div>
            </div>
            {{-- delete modal --}}
            <div class="modal fade" id="deleteUser">
                <div class="modal-dialog">
                    <div class="modal-content bg-danger">
                        <div class="modal-header">
                            <h4 class="modal-title text-dark"> Delete User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-white">
                                Are you sure you want to permenently delete this user's information?
                            </p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-outline-light bg-green"
                                data-dismiss="modal">Close</button>
                            <a href="{{ url('user-action/delete/' . $user->id) }}">
                                <button class="btn btn-outline-light bg-warning">Delete</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            {{-- end delete user modal --}}
        @elseif($type == 'User' && $user->is_approved == false)
            {{-- disabled --}}
            <div class="btn-group mt-2 mb-2 mb-col-4">
                <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                    <span class="p-2">
                        <i class="fas fa-cogs"></i>
                    </span>
                    <span class="p-2">
                        Actions
                    </span>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ url('approve/Active/' . $user->id) }}">
                        <span class="p-2">
                            <i class="fas fa-check text-success"></i>
                        </span>
                        <span>
                            Activate
                        </span>
                    </a>
                    <a class="dropdown-item" href="{{ url('user-action/archive/' . $user->id) }}">
                        <span class="p-2">
                            <i class="fas fa-briefcase text-secondary"></i>
                        </span>
                        <span>
                            Archive
                        </span>
                    </a>

                    {{-- delete user btn & modal --}}
                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#deleteUser">
                        <span class="p-2">
                            <i class="fas fa-trash text-red"></i>
                        </span>
                        <span>
                            Delete
                        </span>
                    </button>
                    {{-- end delete user modal --}}

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-green" href="#">Request Help</a>
                </div>
            </div>
            {{-- delete modal --}}
            <div class="modal fade" id="deleteUser">
                <div class="modal-dialog">
                    <div class="modal-content bg-danger">
                        <div class="modal-header">
                            <h4 class="modal-title text-dark"> Delete User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-white">
                                Are you sure you want to permenently delete this user's information?
                            </p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-outline-light bg-green"
                                data-dismiss="modal">Close</button>
                            <a href="{{ url('user-action/delete/' . $user->id) }}">
                                <button class="btn btn-outline-light bg-warning">Delete</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            {{-- end delete user modal --}}
        @elseif($type == 'Farmer')
            <div class="btn-group mt-2 mb-2 mb-col-4">
                <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                    <span class="p-2">
                        <i class="fas fa-cogs"></i>
                    </span>
                    <span class="p-2">
                        Actions
                    </span>
                </button>
                <div class="dropdown-menu">
                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#deleteUser">
                        <span class="p-2">
                            <i class="fas fa-trash text-red"></i>
                        </span>
                        <span>
                            Delete
                        </span>
                    </button>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-green" href="#">Request Help</a>
                </div>
            </div>
            {{-- edit btn --}}
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#editUser">
                <span>
                    Edit
                </span>
                <span class="ml-2">
                    <i class="fa fa-edit"></i>
                </span>
            </button>

            {{-- edit modal --}}
            <div class="modal fade" id="editUser">
                <div class="modal-dialog">
                    <div class="modal-content bg-primary">
                        <div class="modal-header">
                            <h4 class="modal-title text-dark">
                                <h3 class="card-title">Edit User</h3>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        {{-- amend form --}}
                        <form action="{{ route('user-update', [$type, $user->id]) }}" method="post">
                            @csrf
                            {{-- all requisitions --}}
                            <div class="card bg-yellow p-3">
                                {{-- first name --}}
                                <div class="text-dark-bg-light p-2">
                                    <div>
                                        <label for="">First Name</label>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control" name="first_name"
                                            value="{{ $user->first_name }}" placeholder="{{ $user->first_name }}">
                                    </div>
                                </div>
                                {{-- last name --}}
                                <div class="text-dark-bg-light p-2">
                                    <div>
                                        <label for="">Last Name</label>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control" name="last_name"
                                            value="{{ $user->last_name }}" placeholder="{{ $user->last_name }}">
                                    </div>
                                </div>
                                {{-- phone_number --}}
                                <div class="text-dark-bg-light p-2">
                                    <div>
                                        <label for="">Phone Number</label>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control" name="phone_number"
                                            value="{{ $user->phone_number }}" placeholder="{{ $user->phone_number }}">
                                    </div>
                                </div>
                                {{-- level --}}
                                <div class="text-dark-bg-light p-2">
                                    <div>
                                        <label for="">Type</label>
                                    </div>
                                    <div>
                                        <select name="type" class="form-control" value="{{ $user->type }}">
                                            <option value="Under Training">Under Training</option>
                                            <option value="Adopter Farmer">Adopter Farmer</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- ward_name --}}
                                <div class="text-dark-bg-light p-2">
                                    <div>
                                        <label for="">Ward</label>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control" name="ward_name"
                                            value="{{ $user->ward_name }}" placeholder="{{ $user->ward_name }}">
                                    </div>
                                </div>
                                {{-- btn --}}
                                <button class="btn btn-success m-3">
                                    Edit
                                </button>
                            </div>
                        </form>
                    </div>
                    </form>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        @endif

        {{-- conditional view --}}
        @if ($type == 'User')
            {{-- elevate bar --}}
            <div class="btn-group mt-2 mb-2 mb-col-4">
                <button type="button" class="btn btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown">
                    <span class="p-2">
                        <i class="fas fa-sort"></i>
                    </span>
                    <span>
                        Elevate User
                    </span>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ url('user-elevate/up/' . $user->id) }}">
                        <span class="p-2">
                            <i class="fas fa-arrow-up"></i>
                        </span>
                        <span>
                            Up
                        </span>
                    </a>
                    <a class="dropdown-item" href="{{ url('user-elevate/down/' . $user->id) }}">
                        <span class="p-2">
                            <i class="fas fa-arrow-down"></i>
                        </span>
                        <span>
                            Down
                        </span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-green" href="#">Request Help</a>
                </div>
            </div>

            {{-- edit btn --}}
            <button class="btn btn-primary mt-2 mb-2" type="button" data-toggle="modal" data-target="#editUser">
                <span>
                    Edit
                </span>
                <span class="ml-2">
                    <i class="fa fa-edit"></i>
                </span>
            </button>

            {{-- edit modal --}}
            <div class="modal fade" id="editUser">
                <div class="modal-dialog">
                    <div class="modal-content bg-primary">
                        <div class="modal-header">
                            <h4 class="modal-title text-dark">
                                <h3 class="card-title">Edit User</h3>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        {{-- amend form --}}
                        <form action="{{ route('user-update', [$type, $user->id]) }}" method="post">
                            @csrf
                            {{-- all requisitions --}}
                            <div class="card bg-yellow p-3">
                                {{-- first name --}}
                                <div class="text-dark-bg-light p-2">
                                    <div>
                                        <label for="">First Name</label>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control" name="first_name"
                                            value="{{ $user->first_name }}" placeholder="{{ $user->first_name }}">
                                    </div>
                                </div>
                                {{-- last name --}}
                                <div class="text-dark-bg-light p-2">
                                    <div>
                                        <label for="">Last Name</label>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control" name="last_name"
                                            value="{{ $user->last_name }}" placeholder="{{ $user->last_name }}">
                                    </div>
                                </div>
                                {{-- phone_number --}}
                                <div class="text-dark-bg-light p-2">
                                    <div>
                                        <label for="">Phone Number</label>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control" name="phone_number"
                                            value="{{ $user->phone_number }}" placeholder="{{ $user->phone_number }}">
                                    </div>
                                </div>
                                {{-- email --}}
                                <div class="text-dark-bg-light p-2">
                                    <div>
                                        <label for="">Email</label>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control" name="email"
                                            value="{{ $user->email }}" placeholder="{{ $user->email }}">
                                    </div>
                                </div>
                                {{-- ward_name --}}
                                <div class="text-dark-bg-light p-2">
                                    <div>
                                        <label for="">Ward</label>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control" name="ward_name"
                                            value="{{ $user->ward_name }}" placeholder="{{ $user->ward_name }}">
                                    </div>
                                </div>
                                {{-- btn --}}
                                <button class="btn btn-success m-3">
                                    Edit
                                </button>
                            </div>
                        </form>
                    </div>
                    </form>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        @endif

        {{-- messanger bar --}}
        <div class="btn-group mt-2 mb-2 mb-col-4">
            <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                <span class="p-2">
                    <i class="fas fa-comments"></i>
                </span>
                <span class="p-2">
                    Messenger
                </span>
            </button>
            <div class="dropdown-menu">
                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#messageUser">
                    <span class="p-2">
                        <i class="fas fa-comment text-primary"></i>
                    </span>
                    <span>
                        Create S.M.S
                    </span>
                </button>
                <a class="dropdown-item" href="{{ url('user-messenger/email') }}">
                    <span class="p-2">
                        <i class="fas fa-envelope text-yellow"></i>
                    </span>
                    <span>
                        Create Email
                    </span>
                </a>
                <a class="dropdown-item" href="{{ url('user-messenger/newsletter') }}">
                    <span class="p-2">
                        <i class="fas fa-newspaper text-green"></i>
                    </span>
                    <span>
                        Send Newsletter
                    </span>
                </a>
            </div>
        </div>

        {{-- messenger modal --}}
        <div class="modal fade" id="messageUser">
            <div class="modal-dialog">
                <div class="modal-content bg-success">
                    <div class="modal-header">
                        <h4 class="modal-title text-dark"> Create S.M.S</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="" method="post">
                        @csrf
                        <div class="modal-body">
                            <label for="">Write S.M.S</label>
                            <textarea name="message" id="" cols="30" rows="10" class="form-control">

                            </textarea>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-outline-light bg-danger"
                                data-dismiss="modal">Close</button>
                            <button class="btn btn-outline-light bg-warning">Send</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        {{-- end modal --}}


        {{-- user details --}}
        <div class="container border-top border-bottom p-3">
            <div class="row">
                {{-- user details --}}
                <div class="col-lg-6 col-md-6">
                    <h3>User Details</h3>
                    <div class="row mt-2">
                        <div class="col-4">
                            <div class="">
                                <label>Name:</label>
                            </div>
                            <div class="">
                                {{ $user->first_name }} {{ $user->last_name }}
                            </div>
                        </div>
                        <div class="col-4">
                            @isset($user->email)
                                <div class="">
                                    <label>Email:</label>
                                </div>
                                <div class="">
                                    {{ $user->email }}
                                </div>
                            @endisset
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4">
                            <div class="">
                                <label>Phone Number:</label>
                            </div>
                            <div class="">
                                {{ $user->phone_number }}
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        @if ($type == 'User')
                            <div class="row mt-2 mb-2">
                                <div class="col-4">
                                    <div class="">
                                        <label>Role Name:</label>
                                    </div>
                                    <div class="">
                                        {{ ucfirst($user->roleUser->name) }}
                                    </div>
                                </div>
                                @isset($user->createdBy->first_name)
                                    <div class="col-4">
                                        <div class="">
                                            <label>Created By:</label>
                                        </div>
                                        <div class="">
                                            {{ ucfirst($user->createdBy->first_name) }}
                                            {{ ucfirst($user->createdBy->last_name) }}
                                        </div>
                                    </div>
                                @endisset
                            </div>
                        @else
                            <div class="row mt-2 mb-2">
                                {{-- created by --}}
                                <div class="col-4">
                                    <div class="">
                                        <label>Created By:</label>
                                    </div>
                                    <div class="">
                                        {{ $user->createdBy->first_name }} {{ $user->createdBy->last_name }}
                                    </div>
                                </div>

                                {{-- farmer type --}}
                                <div class="col-4">
                                    <div class="">
                                        <label>Type:</label>
                                    </div>
                                    <div class="btn btn-sm btn-success">
                                        {{ $user->type }}
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2 mb-2">
                                {{-- disablity name --}}
                                @isset($user->disability_name)
                                    <div class="col-4">
                                        <div class="">
                                            <label>Disability Name:</label>
                                        </div>
                                        <div class="">
                                            {{ $user->disability_name }}
                                        </div>
                                    </div>
                                @endisset

                                {{-- disability note --}}
                                @isset($user->disability_note)
                                    <div class="col-4">
                                        <div class="">
                                            <label>Disability Note:</label>
                                        </div>
                                        <div class="">
                                            {{ $user->disability_note }}
                                        </div>
                                    </div>
                                @endisset
                            </div>

                            {{-- additional information --}}
                            <div class="row">
                                @isset($user->note)
                                    <div class="col-4">
                                        <div class="">
                                            <label>Additional Information:</label>
                                        </div>
                                        <div class="">
                                            {{ $user->note }}
                                        </div>
                                    </div>
                                @endisset
                            </div>
                        @endif
                    </div>
                    <div class="row mt-2">
                        <div class="col-4">
                            <div class="">
                                <label>County:</label>
                            </div>
                            <div class="">
                                {{ $user->county }}
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="">
                                <label>Sub County:</label>
                            </div>
                            <div class="">
                                {{ $user->sub_county }}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4">
                            <div class="">
                                <label>Region:</label>
                            </div>
                            <div class="">
                                {{ $user->regions->name }}
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="">
                                <label>Ward:</label>
                            </div>
                            <div class="">
                                {{ $user->ward_name }}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- user photo --}}
                @if ($type == 'User')
                    <div class="col-6">
                        <h3>Profile Photo</h3>
                        <div>
                            <img src="{{ asset('img/' . $user->avatars->file_path) }}" alt="no profile photo">
                        </div>
                    </div>
                @endif
            </div>

            {{-- relation data analysis for a single user --}}
            @if ($type == 'User')
                {{-- user details --}}
                <div class="card card-primary card-outline mt-4 mb-4">
                    <h3>{{ $type }} Details</h3>
                    <div class="card-body mt-3">
                        <div class="row">
                            <div class="col-5 col-sm-3">
                                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                                    aria-orientation="vertical">
                                    <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill"
                                        href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home"
                                        aria-selected="true">Activities</a>
                                    <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill"
                                        href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile"
                                        aria-selected="false">Requisitions</a>
                                    <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill"
                                        href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages"
                                        aria-selected="false">Disbursments</a>
                                    <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill"
                                        href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings"
                                        aria-selected="false">Payment Proof</a>
                                </div>
                            </div>
                            <div class="col-7 col-sm-9">
                                <div class="tab-content" id="vert-tabs-tabContent">
                                    <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel"
                                        aria-labelledby="vert-tabs-home-tab">
                                        {{-- activities item --}}
                                        <div class="row p-2">
                                            @if (isset($activities) && count($activities) > 0)
                                                @foreach ($activities as $activity)
                                                    <div class="row">
                                                        <div class="card col-mb-4 p-2 m-2">
                                                            <div>
                                                                <span class="mr-2"> Name : {{ $activity->name }}
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <span class="mr-2"> Start Date :
                                                                    {{ $activity->start_date }}
                                                                </span>

                                                                <span class="mr-2"> End Date :
                                                                    {{ $activity->end_date }}
                                                                </span>

                                                            </div>
                                                            <div>
                                                                <span>Description: {{ $activity->description }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                No activity approved for this user,
                                            @endif
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel"
                                        aria-labelledby="vert-tabs-profile-tab">
                                        <div class="row">
                                            {{-- Requisitions --}}
                                            <div class="row p-2">
                                                @if (isset($requisitions) && count($requisitions) > 0)
                                                    @foreach ($requisitions as $item)
                                                        <div class="card col-mb-4 p-2 m-2">
                                                            <div>
                                                                <span class="mr-2"> Name : {{ $item->name }}
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <span class="mr-2"> Expense Category :
                                                                    {{ $item->category }}
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <span class="mr-2"> Expense Sub Category :
                                                                    {{ $item->sub_category }}
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <span>County: {{ $item->county }}</span>
                                                            </div>
                                                            <div>
                                                                <span>Region: {{ $item->region_name }}</span>
                                                            </div>
                                                            <div>
                                                                <span>Ward Name: {{ $item->area_name }}</span>
                                                            </div>
                                                            <div>
                                                                <span>Description: {{ $item->note }}</span>
                                                            </div>
                                                            @if ($item->activity_id != null)
                                                                <div>
                                                                    <span>Activity name:
                                                                        {{ $item->activities->name }}</span>
                                                                </div>
                                                            @elseif($item->activity_id == null && $item->pdm_id != null)
                                                                <div>
                                                                    <span>Per Diem name:
                                                                        {{ $item->pdms->name }}</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                @else
                                                    No requisitions approved for this user,
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel"
                                        aria-labelledby="vert-tabs-messages-tab">
                                        {{-- disbursments --}}
                                        <div class="row p-2">
                                            @if (isset($budgets) && count($budgets) > 0)
                                                @foreach ($budgets as $item)
                                                    @if ($item->is_disbursed != null)
                                                        <div class="card col-mb-4 p-2 m-2">
                                                            <div>
                                                                <span class="mr-2"> Name : {{ $item->name }}
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <span class="mr-2"> Expense Category :
                                                                    {{ $item->category }}
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <span class="mr-2"> Expense Sub Category :
                                                                    {{ $item->sub_category }}
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <span>Type: {{ $item->type }}</span>
                                                            </div>
                                                            @if ($item->activity_id != null)
                                                                <div>
                                                                    <span>Activity name:
                                                                        {{ $item->activities->name }}</span>
                                                                </div>
                                                                <div>
                                                                    <span>Requisition name:
                                                                        {{ $item->requisitions->name }}</span>
                                                                </div>
                                                            @elseif($item->pdm_id != null)
                                                                <div>
                                                                    <span>Per Diem name:
                                                                        {{ $item->pdms->name }}</span>
                                                                </div>
                                                            @endif
                                                            <div>
                                                                <span>Confirmed By:
                                                                    {{ $item->confirmedBy->first_name }}
                                                                    {{ $item->confirmedBy->last_name }}
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <span>Disbursed By:
                                                                    {{ $item->disbursedBy->first_name }}
                                                                    {{ $item->disbursedBy->last_name }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @else
                                                No disbursment made to this user,
                                            @endif
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel"
                                        aria-labelledby="vert-tabs-settings-tab">
                                        {{-- payment proof --}}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            @elseif($type == 'Farmer')
                {{-- user details --}}
                <div class="card card-primary card-outline mt-4 mb-4">
                    <h3>{{ $type }} Details</h3>
                    <div class="card-body mt-3">
                        <div class="row">
                            <div class="col-5 col-sm-3">
                                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                                    aria-orientation="vertical">
                                    <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill"
                                        href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home"
                                        aria-selected="true">Activities</a>
                                    <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill"
                                        href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile"
                                        aria-selected="false">Attendance Logs</a>
                                    <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill"
                                        href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages"
                                        aria-selected="false">Payments</a>
                                </div>
                            </div>
                            <div class="col-7 col-sm-9">
                                <div class="tab-content" id="vert-tabs-tabContent">
                                    <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel"
                                        aria-labelledby="vert-tabs-home-tab">
                                        {{-- activities item --}}
                                        <div class="row p-2">
                                            @if (isset($activities) && count($activities) > 0)
                                                @foreach ($activities as $activity)
                                                    <div class="row">
                                                        <div class="card col-mb-4 p-2 m-2">
                                                            <div>
                                                                <span class="mr-2"> Name : {{ $activity->name }}
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <span class="mr-2"> Start Date :
                                                                    {{ $activity->start_date }}
                                                                </span>

                                                                <span class="mr-2"> End Date :
                                                                    {{ $activity->end_date }}
                                                                </span>

                                                            </div>
                                                            <div>
                                                                <span>Description: {{ $activity->description }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                No activity approved for this farmer,
                                            @endif
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel"
                                        aria-labelledby="vert-tabs-profile-tab">
                                        <div class="row">
                                            {{-- Attendance --}}
                                            <div class="row p-2">
                                                @if (isset($attendances) && count($attendances) > 0)
                                                    @foreach ($attendances as $item)
                                                        <div class="card col-mb-4 p-2 m-2">
                                                            <div>
                                                                <span class="mr-2"> Name : {{ $item->member_name }}
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <span class="mr-2"> Activity Name :
                                                                    {{ $item->activities->name }}
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <span class="mr-2"> Date :
                                                                    {{ $item->created_at }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    Farmer has not attendend any activity,
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel"
                                        aria-labelledby="vert-tabs-messages-tab">
                                        {{-- payments --}}
                                        <div class="row p-2">
                                            @if (isset($requisitions) && count($requisitions) > 0)
                                                @foreach ($requisitions as $item)
                                                    @if ($item->is_disbursed == true)
                                                        <div class="card col-mb-4 p-2 m-2">
                                                            <div>
                                                                <span class="mr-2"> Name : {{ $item->name }}
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <span class="mr-2"> Expense Category :
                                                                    {{ $item->category }}
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <span class="mr-2"> Expense Sub Category :
                                                                    {{ $item->sub_category }}
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <span>County: {{ $item->county }}</span>
                                                            </div>
                                                            <div>
                                                                <span>Region: {{ $item->region_name }}</span>
                                                            </div>
                                                            <div>
                                                                <span>Ward Name: {{ $item->area_name }}</span>
                                                            </div>
                                                            <div>
                                                                <span>Description: {{ $item->note }}</span>
                                                            </div>
                                                            <div>
                                                                <span>Approved By:
                                                                    {{ $item->approved_by_name }}</span>
                                                            </div>
                                                            <div>
                                                                <span>Disbursed By:
                                                                    {{ $item->disbursed_by_name }}</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @else
                                                No payments made to this user,
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            @else
                <div class="card m-auto bg-yellow">
                    <p class="text-white font-weight-bold p-2">
                        #Error Code = 2179601 <br>
                        System did not pick your user account type. Logout and Login again. <br>

                    </p>
                </div>
            @endif

        @endsection

        {{-- section custom scripts --}}
        @section('adminScripts')
            {{-- include datatable scripts --}}
            @include('admin.types.inc.datatables_script')
        @endsection
