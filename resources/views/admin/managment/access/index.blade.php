@extends('layouts.admin')

@section('page')
    {{-- include top nav --}}
    @include('admin.inc.admin_top_nav')

    {{-- include side nav --}}
    @include('admin.inc.admin_side_nav')

    {{--managment dashboard contents --}}

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        {{-- breadcrumbs --}}
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <!-- (Stats boxes) -->
                <div class="row text-dark">
                    <!-- Farmers -->
                    <div class="col-lg-3 col-6 text-dark font-weight-bold text-l">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3></h3> 

                                <p>Users</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ url('user-users') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- Staff -->
                    <div class="col-lg-3 col-6 text-dark font-weight-bold text-l">
                        <!-- small box -->
                        <div class="small-box bg-gray">
                            <div class="inner">
                                <h3></h3>

                                <p>Bulk SMS</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ url('sms_manager') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- Reports -->
                    <div class="col-lg-3 col-6 text-dark font-weight-bold text-l">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3></h3>

                                <p>Finance</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ url('payment-analysis') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- Reports -->
                    <div class="col-lg-3 col-6 text-dark font-weight-bold text-l">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3></h3>

                                <p>OTP</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ url('otp') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>


                    <!-- Calender -->
                    {{-- <div class="col-lg-3 col-6 text-dark font-weight-bold text-l">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>6</h3>

                                <p>Calender</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div> --}}
                    <!-- ./col -->
                </div>

                {{-- graphical data representation --}}
                {{-- <div class="card rounded-0 m-2 border">
                    {{-- heading --}}
                    {{-- <h4><u>GRAPHICAL DATA ANALYSIS</u></h4>
                    <div class="row p-2"> --}}

                        {{-- bar graph to show relationship between regions and farmers --}}
                        {{-- <div class="col-md-6 border"> --}}
                            {{-- graph heading --}}
                            {{-- <small class="font-weight-bold text-green p-3">Registered Users over time.</small>
                            <div class="container-fluid p-5">
                              <canvas id="myChart" height="100px"></canvas>
                            </div> --}}
                        {{-- </div> --}}

                        {{-- bar graph to show relationship between ages and farmers --}}
                        {{-- <div class="col-md-6 border"> --}}
                            {{-- graph heading --}}
                            {{-- <small class="font-weight-bold text-green p-3">Farmers in different age groups.</small> --}}
                        {{-- </div> --}}
                    {{-- </div> --}}

                    {{-- <div class="row"> --}}
                        {{-- pie chart to show relationship between expenditure over time --}}
                        {{-- <div class="col-md-6 border"> --}}
                            {{-- chart heading --}}
                            {{-- <small class="font-weight-bold text-green p-3">Expenditure over time.</small> --}}
                        {{-- </div> --}}

                        {{-- pie chart to show relationship between expenditure and module --}}
                        {{-- <div class="col-md-6 border"> --}}
                            {{-- chart heading --}}
                            {{-- <small class="font-weight-bold text-green p-3">Amount(ksh) spent in modules.</small> --}}
                        {{-- </div> --}}
                    {{-- </div> --}}
                {{-- </div> --}}

            </div>
            <!-- /.container-fluid -->
            {{-- scripts --}}
            {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
            {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}

            {{-- <script type="text/javascript">
                var labels = {{ Js::from($labels) }};
                var users = {{ Js::from($data) }};

                const data = {
                    labels: labels,
                    datasets: [{
                        label: 'Users over time',
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: users,
                    }]
                };

                const config = {
                    type: 'bar',
                    data: data,
                    options: {}
                };

                const myChart = new Chart(
                    document.getElementById('myChart'),
                    config
                );
            </script> --}}
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; PAFID <a href="#"></a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Powered By</b> EASYFIND TECHNOLOGIES
        </div>
    </footer>
@endsection
