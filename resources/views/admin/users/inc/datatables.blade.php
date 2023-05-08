{{-- user datatable --}}

@if (Auth::user()->hasRole('F.C'))
    {{-- data card --}}
    <div class="card">

        {{-- heading --}}
        <div class="card-header">
            <h3 class="card-title">Data-table showing all {{ ucfirst($type) }}s</h3>
        </div>

        {{-- body --}}
        <div class="card-body">

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone Number</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>County</th>
                        <th>Sub County</th>
                        <th>Region</th>
                        <th>Area</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($users) && count($users) > 0)
                        @foreach ($users as $user)
                            @if ($user->first_name != 'System' && $user->last_name != 'Administrator')
                                <tr>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>{{ $user->age }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->county }}</td>
                                    <td>{{ $user->sub_county }}</td>
                                    <td>
                                        @if ($user->region_id != null)
                                            {{ $user->regions->name }}
                                        @else
                                            n/a
                                        @endif
                                    </td>
                                    <td>{{ $user->ward_name }}</td>
                                    <td>
                                        <a href="{{ url('user-view/' . $type . '/' . $user->id) }}">
                                            <span>View</span>
                                            <span class="ml-2">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @else
                        <small class="text-red">
                            {{ auth()->user()->first_name }} {{ auth()->user()->last_name }} you have not created any Farmer using this MIS platform. 
                            This might affect your timeley performance index analysis. Click on the HELP button or contact Pafid System Support on, <br>
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
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone Number</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>County</th>
                        <th>Sub County</th>
                        <th>Region</th>
                        <th>Area</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@else
    {{-- data card --}}
    <div class="card">

        {{-- heading --}}
        <div class="card-header">
            <h3 class="card-title">Data-table showing all {{ ucfirst($type) }}s</h3>
        </div>

        {{-- body --}}
        <div class="card-body">

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone Number</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>County</th>
                        <th>Sub County</th>
                        <th>Region</th>
                        <th>Area</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($users) && count($users) > 0)
                        @foreach ($users as $user)
                            @if ($user->first_name != 'System' && $user->last_name != 'Administrator')
                                <tr>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>{{ $user->age }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->county }}</td>
                                    <td>{{ $user->sub_county }}</td>
                                    <td>
                                        @if ($user->region_id != null)
                                            {{ $user->regions->name }}
                                        @else
                                            n/a
                                        @endif
                                    </td>
                                    <td>{{ $user->ward_name }}</td>
                                    <td>
                                        <a href="{{ url('user-view/' . $type . '/' . $user->id) }}">
                                            <span>View</span>
                                            <span class="ml-2">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @else
                        <p class="font-weight-bold"> Data Unavailable!</p>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone Number</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>County</th>
                        <th>Sub County</th>
                        <th>Region</th>
                        <th>Area</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endif
