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
                        <h1 class="m-0 text-dark">{{ $activity->name }} activity manager</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard_index">Dashboard</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="container-fluid">
                    {{-- include alert messages --}}
                    @include('alerts.messages')

                    {{-- main content --}}
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-edit"></i>
                                {{ $activity->name }} Information
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                                        aria-orientation="vertical">
                                        <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill"
                                            href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home"
                                            aria-selected="true">Information</a>
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
                                <div class="col-12">
                                    <div class="tab-content" id="vert-tabs-tabContent">
                                        {{-- information --}}
                                        <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel"
                                            aria-labelledby="vert-tabs-home-tab">
                                            {{-- row item --}}
                                            <div class="row mt-2 p-2">
                                                {{-- name --}}
                                                <div class="card col-md-4 d-flex">
                                                    <div>
                                                        {{ $activity->type }} Name:
                                                    </div>
                                                    <div>
                                                        {{ $activity->name }}
                                                    </div>
                                                </div>
                                                {{-- county --}}
                                                <div class="card col-md-4 d-flex">
                                                    <div>
                                                        {{ $activity->type }} County:
                                                    </div>
                                                    <div>
                                                        {{ $activity->county }}
                                                    </div>
                                                </div>
                                                {{-- sub county --}}
                                                <div class="card col-md-4 d-flex">
                                                    <div>
                                                        {{ $activity->type }} Sub County:
                                                    </div>
                                                    <div>
                                                        {{ $activity->sub_county }}
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- row item --}}
                                            <div class="row mt-2">
                                                {{-- region --}}
                                                <div class="card col-md-4 d-flex">
                                                    <div>
                                                        {{ $activity->type }} Region:
                                                    </div>
                                                    <div>
                                                        {{ $activity->regions->name }}
                                                    </div>
                                                </div>
                                                {{-- area --}}
                                                <div class="card col-md-4 d-flex">
                                                    <div>
                                                        {{ $activity->type }} Ward:
                                                    </div>
                                                    <div>
                                                        {{ $activity->area_name }}
                                                    </div>
                                                </div>
                                                <div class="card col-md-4 d-flex">
                                                    <div>
                                                        {{ $activity->type }} Created By:
                                                    </div>
                                                    <div>
                                                        {{ $activity->created_by_name }}
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- row item --}}
                                            <div class="row mt-2">
                                                {{-- Start Time --}}
                                                <div class="card col-md-6 d-flex">
                                                    <div class="p-2">
                                                        <span class="mr-2">{{ $activity->type }} Start Date:</span>
                                                        <span>{{ $activity->start_date }}</span>
                                                    </div>
                                                    <div class="p-2">
                                                        <span class="mr-2">{{ $activity->type }} Start Time:</span>
                                                        <span>{{ $activity->start_time }}hrs</span>
                                                    </div>
                                                </div>
                                                {{-- End Time --}}
                                                <div class="card col-md-6 d-flex">
                                                    <div class="p-2">
                                                        <span class="mr-2">{{ $activity->type }} End Date:</span>
                                                        <span>{{ $activity->end_date }}</span>
                                                    </div>
                                                    <div class="p-2">
                                                        <span class="mr-2">{{ $activity->type }} End Time:</span>
                                                        <span>{{ $activity->end_time }}hrs</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- requisitions --}}
                                        <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel"
                                            aria-labelledby="vert-tabs-profile-tab">
                                            <div class="row">
                                                {{-- Approved Requisitions --}}
                                                <div class="card col-md-12">
                                                    <div>
                                                        {{ $activity->type }} Approved Requisitions:
                                                    </div>
                                                    <div class="row p-2">
                                                        @if (isset($requisitions) && count($requisitions) > 0)
                                                            @foreach ($requisitions as $item)
                                                                <div class="card col-mb-4 p-2 m-2">
                                                                    <div>
                                                                        <span class="mr-2"> Name : {{ $item->name }}
                                                                        </span>
                                                                        <span>Amount: {{ $item->amount }}</span>
                                                                    </div>
                                                                    <div>
                                                                        <span class="mr-2"> Created at :
                                                                            {{ $item->created_at->diffForHumans() }}
                                                                        </span>

                                                                    </div>
                                                                    @if ($item->is_approved == true)
                                                                        <div>
                                                                            <span>Approved By:
                                                                                {{ $item->approved_by_name }}</span>
                                                                        </div>
                                                                    @elseif($item->is_rejected == false)
                                                                        <div>
                                                                            <span>Pending Approval</span>
                                                                        </div>
                                                                    @elseif($item->is_rejected == true)
                                                                        <div>
                                                                            <span class="text-red">Requisition
                                                                                Rejected</span>
                                                                        </div>
                                                                    @endif

                                                                    <div>
                                                                        <span>Disbursed By:
                                                                            {{ $item->disbursed_by_name }}</span>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            No requisitions made for this {{ $activity->type }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Disbursments --}}
                                        <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel"
                                            aria-labelledby="vert-tabs-messages-tab">
                                            <div class="row">
                                                {{-- Approved Disbursments --}}
                                                <div class="card col-md-6">
                                                    <div>
                                                        {{ $activity->type }} Approved Disbursments:
                                                    </div>
                                                    <div class="row p-2">
                                                        @if (isset($disbursment) && count($disbursment) > 0)
                                                            @foreach ($disbursment as $item)
                                                                <div class="card col-mb-4 p-2 m-2">
                                                                    <div>
                                                                        <span class="mr-2"> Name : {{ $item->name }}
                                                                        </span>
                                                                        <span>Amount: {{ $item->amount }}</span>
                                                                    </div>
                                                                    <div>
                                                                        <span class="mr-2"> Created at :
                                                                            {{ $item->created_at->diffForHumans() }}
                                                                        </span>

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
                                                            @endforeach
                                                        @else
                                                            No requisitions made for this {{ $activity->type }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Payment Proof --}}
                                        <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel"
                                            aria-labelledby="vert-tabs-settings-tab">
                                            <div class="row p-2">
                                                @if (isset($proof) && count($proof) > 0)
                                                    @foreach ($proof as $item)
                                                        <div class="card col-mb-4 p-2 m-2">
                                                            <div>
                                                                <span class="mr-2"> Name : {{ $item->name }} </span>
                                                                <span>Amount: {{ $item->amount }}</span>
                                                            </div>
                                                            <div>
                                                                <span class="mr-2"> Details : {{ $item->details }}
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <span class="mr-2"> Created at :
                                                                    {{ $item->created_at->diffForHumans() }} </span>

                                                            </div>
                                                            @if ($item->is_audited == true)
                                                                <div class="btn btn-success">Confirmed</div>
                                                            @else
                                                                <div class="btn btn-warning">Pending Confirmation</div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                @else
                                                    No made for this {{ $activity->type }}
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>

                        </div>
                    </div>

                    <div class="card card-primary col-12">
                        <div class="mt-3 mb-3 font-weight-bold text-green text-center">
                            <p class="border-bottom p-3">
                                ATTENDANCE LIST
                            </p>
                        </div>
                        <div class="m-auto">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <th>
                                        Farmer Name
                                    </th>
                                    <th>
                                        Phone Number
                                    </th>
                                    <th>
                                        Attendance Date
                                    </th>
                                    <th>
                                        F.C Name
                                    </th>
                                    <th>
                                        F.C Contact
                                    </th>
                                </thead>
                                <tbody>
                                    @if ($farmers)
                                        @foreach ($farmers as $dF)
                                            @foreach ($dF as $item)
                                                <tr>
                                                    <td>
                                                        {{ $item->member_name }}
                                                    </td>
                                                    <td>
                                                        {{ $item->farmer->phone_number }}
                                                    </td>
                                                    <td>
                                                        {{ $item->attendance_date }}
                                                    </td>
                                                    <td>
                                                        {{ $item->users->first_name }} {{ $item->users->last_name }}
                                                    </td>
                                                    <td>
                                                        {{ $item->users->phone_number }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @else
                                        No farmer has attended this activity.
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    @endsection
