@extends('layouts.admin')

@section('page')
    <!-- include top nav -->
    @include('admin.inc.admin_top_nav')

    <!-- include side nav -->
    @include('admin.inc.admin_side_nav')

    <!-- managment dashboard contents -->

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

                                <p>Farmers</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- Staff -->
                    <div class="col-lg-3 col-6 text-dark font-weight-bold text-l">
                        <!-- small box -->
                        <div class="small-box bg-gray">
                            <div class="inner">
                                <h3></h3>

                                <p>Activities</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- Reports -->
                    <div class="col-lg-3 col-6 text-dark font-weight-bold text-l">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3></h3>

                                <p>Requisitions</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- Calender -->
                    <div class="col-lg-3 col-6 text-dark font-weight-bold text-l">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <p>Calender</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>

                

            </div>
            <!-- /.container-fluid -->

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
