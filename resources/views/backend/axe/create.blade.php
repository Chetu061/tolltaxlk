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
                            <h1>Add Axel</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Add Axel</li>
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
                                    <h3 class="card-title">Axel Add</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="{{ route('axe.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                    <div class="col-md-6 col-sm-12">
                                            <label for="axelno">Enter Axel Number</label>
                                            <input type="text" class="form-control" id="axelno"
                                                placeholder="Enter Axel Number" name="axelno" required>
                                            @if ($errors->has('axelno'))
                                                <div class="error text-danger">{{ $errors->first('axelno') }}</div>
                                            @endif
                                        </div>
                                        <!-- <div class="col-md-6 col-sm-12">
                                            <label for="tax_rate">Enter Tax Rate</label>
                                            <input type="number" step="0.01" class="form-control" id="tax_rate"
                                                placeholder="Enter Tax Rate" name="tax_rate" >
                                            @if ($errors->has('tax_rate'))
                                                <div class="error text-danger">{{ $errors->first('tax_rate') }}</div>
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
