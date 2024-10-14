@php
use App\Models\User;

$userCount = User::count();
use App\Models\Toll;

$tollCount = Toll::count();
use App\Models\Location;

$location = Location::count();
@endphp
<!-- not used in project -->
@extends('master.backendmaster')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Admin Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">AdminDashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1">
                                <i class="fas fa-users"></i>

                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total User</span>
                                <span class="info-box-number">
                                 {{$userCount}}
                                    {{-- <small>%</small> --}}
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1">
                                <i class="fas fa-thumbs-up"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Toll</span>
                                <span class="info-box-number">{{$tollCount}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Location</span>
                                <span class="info-box-number">{{$location}}</span>
                            </div>
                       
                        </div>
                       
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1">
                                <i class="fas fa-home"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Today Cases</span>
                                <span class="info-box-number">2,000</span>
                            </div>
                           
                        </div>
                       
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-secondary elevation-1">
                                <i class="fas fa-envelope"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Next Day Cases</span>
                                <span class="info-box-number">
                                    10
                                    <small>%</small>
                                </span>
                            </div>
                           
                        </div>
                      
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-light elevation-1">
                                <i class="fas fa-cog"></i>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Court</span>
                                <span class="info-box-number"></span>
                            </div>
                          
                        </div>
                        
                    </div>
                    
                </div> -->
                <!-- /.row -->


                <!-- /.row -->

                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <div class="col-md-8">
                        <!-- MAP & BOX PANE -->

                        <!-- /.card -->

                        <!-- /.row -->

                        <!-- TABLE: LATEST ORDERS -->

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->


                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
@endsection
