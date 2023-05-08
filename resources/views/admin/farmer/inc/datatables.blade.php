{{-- user datatable --}}

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
                    <tr>
                        <th>Activity Name</th>
                        <th>Start Date</th>
                        <th>Start Time</th>
                        <th>End Date</th>
                        <th>End Time</th>
                        <th>County</th>
                        <th>Sub County</th>
                        <th>Region</th>
                        <th>Area</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($activities) && count($activities) > 0)
                        @foreach ($activities as $farmerActivity)
                            <tr>
                                <td>{{ $farmerActivity->name }}</td>
                                <td>{{ $farmerActivity->start_date }}</td>
                                <td>{{ $farmerActivity->start_time }}</td>
                                <td>{{ $farmerActivity->end_date }}</td>
                                <td>{{ $farmerActivity->end_time }}</td>
                                <td>{{ $farmerActivity->county }}</td>
                                <td>{{ $farmerActivity->sub_county }}</td>
                                <td>
                                    @if ($farmerActivity->region_id != null)
                                        {{ $farmerActivity->regions->name }}
                                    @else
                                        n/a
                                    @endif
                                </td>
                                <td>{{ $farmerActivity->area_name }}</td>
                                <td>
                                    <a href="{{ url('attendance-list/' . $type . '/' . $farmerActivity->id) }}">
                                        <span>View</span>
                                        <span class="ml-2">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <small class="text-red">
                            {{ auth()->user()->first_name }} {{ auth()->user()->last_name }} you have not created any
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
                    <tr>
                        <th>Activity Name</th>
                        <th>Start Date</th>
                        <th>Start Time</th>
                        <th>End Date</th>
                        <th>End Time</th>
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
