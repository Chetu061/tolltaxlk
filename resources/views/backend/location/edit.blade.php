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
                            <h1>Edit Location </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Edit Location </li>
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
                                    <h3 class="card-title">Location Edit </h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="{{route('location.update',$location->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="card-body">
                                        <div class="form-group">
                                           
                                               <label for="exampleInputEmail1">Enter Location</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                placeholder="Enter Location" value="{{$location->city}}"name="city">
                                                @if ($errors->has('city'))
                <div class="error text-danger">{{ $errors->first('city') }}</div>
            @endif</div>
                                               
                                            </div>
                                           
                                        </div>
                                       
                                     
                                       
                                        
                                    <!-- /.card-body -->

                                    <div class="card-footer" style="display: flex; justify-content: center;">
    <button type="submit" class="btn btn-primary">Update</button>
</div>
                                </form>
                            </div>
                            <!-- /.card -->

                            <!-- general form elements -->

                            <!-- /.card -->

                            <!-- Input addon -->

                            <!-- /.card -->
                            <!-- Horizontal Form -->

                            <!-- /.card -->

                        </div>
                        <!--/.col (left) -->
                        <!-- right column -->

                        <!--/.col (right) -->
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
