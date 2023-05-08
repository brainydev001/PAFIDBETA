@extends('layouts.admin')

@section('page')
    {{-- include top nav --}}
    @include('admin.inc.admin_top_nav')

    {{-- include side nav --}}
    @include('admin.inc.admin_side_nav')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        {{-- include alert messages --}}
        @include('alerts.messages')

        {{-- breadcrumbs --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Calender</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard_index">Dashboard</a></li>
                        </ol>
                    </div><!-- /.col -->
                    <div class="col-sm-12">
                        <div id="calendar"></div>
                    </div>
                </div><!-- /.row -->

            </div><!-- /.container-fluid -->
        </div>

    </div>
@endsection

{{-- section custom scripts --}}
@section('adminScripts')
    {{-- <script>
        $(document).ready(function() {
            var activity = @json($events);
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev, next today',
                    center: 'title',
                    right: 'month, agendaWeek, agendaDay',
                    events: activity,
                },
                
            })
        });
    </script> --}}

    {{-- calender script --}}
    <script type="text/javascript">
        $(document).ready(function() {

            /*------------------------------------------
            --------------------------------------------
            Get Site URL
            --------------------------------------------
            --------------------------------------------*/
            var SITEURL = "{{ url('/') }}";

            /*------------------------------------------
            --------------------------------------------
            CSRF Token Setup
            --------------------------------------------
            --------------------------------------------*/
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /*------------------------------------------
            --------------------------------------------
            FullCalender JS Code
            --------------------------------------------
            --------------------------------------------*/
            var calendar = $('#calendar').fullCalendar({
                editable: true,
                events: SITEURL + "/fullcalender",
                displayEventTime: false,
                editable: true,
                eventLimit: true,
                eventRender: function(event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                // select: function(start, end, allDay) {
                //     var title = prompt('Event Title:');
                //     if (title) {
                //         var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                //         var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                //         $.ajax({
                //             url: SITEURL + "/fullcalenderAjax",
                //             data: {
                //                 title: title,
                //                 start: start,
                //                 end: end,
                //                 type: 'add'
                //             },
                //             type: "POST",
                //             success: function(data) {
                //                 displayMessage("Event Created Successfully");

                //                 calendar.fullCalendar('renderEvent', {
                //                     id: data.id,
                //                     title: title,
                //                     start: start,
                //                     end: end,
                //                     allDay: allDay
                //                 }, true);

                //                 calendar.fullCalendar('unselect');
                //             }
                //         });
                //     }
                // },
                // eventDrop: function(event, delta) {
                //     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                //     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                //     $.ajax({
                //         url: SITEURL + '/fullcalenderAjax',
                //         data: {
                //             title: event.title,
                //             start: start,
                //             end: end,
                //             id: event.id,
                //             type: 'update'
                //         },
                //         type: "POST",
                //         success: function(response) {
                //             displayMessage("Event Updated Successfully");
                //         }
                //     });
                // },
                // eventClick: function(event) {
                //     var deleteMsg = confirm("Do you really want to delete?");
                //     if (deleteMsg) {
                //         $.ajax({
                //             type: "POST",
                //             url: SITEURL + '/fullcalenderAjax',
                //             data: {
                //                 id: event.id,
                //                 type: 'delete'
                //             },
                //             success: function(response) {
                //                 calendar.fullCalendar('removeEvents', event.id);
                //                 displayMessage("Event Deleted Successfully");
                //             }
                //         });
                //     }
                // }

            });

        });

        /*------------------------------------------
        --------------------------------------------
        Toastr Success Code
        --------------------------------------------
        --------------------------------------------*/
        function displayMessage(message) {
            toastr.success(message, 'Event');
        }
    </script>
@endsection
