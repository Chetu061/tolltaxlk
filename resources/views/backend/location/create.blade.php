@extends('master.backendmaster')

@section('content')

<div class="wrapper">
    <!-- Navbar -->
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Location</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add Location</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Location Add</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('location.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                <div class="col-md-6 col-sm-12">
                                        <label for="city">Enter Location</label>
                                        <input type="text" class="form-control" id="city" placeholder="Enter Location" name="city" required>
                                        @if ($errors->has('city'))
                                            <div class="error text-danger">{{ $errors->first('city') }}</div>
                                        @endif
                                    </div>

                                    <!-- <div class="col-md-6 col-sm-12">
                                        <label for="latitude">Latitude</label>
                                        <input type="text" class="form-control" id="latitude" placeholder="Enter Latitude" name="latitude" required>
                                        @if ($errors->has('latitude'))
                                            <div class="error text-danger">{{ $errors->first('latitude') }}</div>
                                        @endif
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <label for="longitude">Longitude</label>
                                        <input type="text" class="form-control" id="longitude" placeholder="Enter Longitude" name="longitude" required>
                                        @if ($errors->has('longitude'))
                                            <div class="error text-danger">{{ $errors->first('longitude') }}</div>
                                        @endif
                                    </div> -->
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer" style="display: flex; justify-content: center;">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <!-- /.control-sidebar -->
</div>

@endsection
