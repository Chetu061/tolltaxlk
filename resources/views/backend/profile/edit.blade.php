
@extends('master.backendmaster')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        
        <!-- Main content -->
        <section class="content">
         
            <div class="container-fluid">
                <div class="row">
                    <!-- Full-width column -->
                    <div class="col-md-12">
                        <!-- Card for Profile Information Edit -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Profile Information Edit</h3>
                            </div>
                            <!-- /.card-header -->
                            
                            <!-- Form start -->
                            <form action="{{ url('/profile/'. $user->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="name">Update Name</label>
                                            <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="name" placeholder="Enter Name">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email">Update Email</label>
                                            <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="email" placeholder="Enter Email">
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label for="contact">Update Contact</label>
                                            <input type="text" name="contact" value="{{ $user->contact }}" class="form-control" id="contact" placeholder="Enter Mobile No">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="current_password">Current Password</label>
                                            <input type="password" name="current_password" class="form-control" id="current_password" placeholder="Enter Current Password">
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label for="password">New Password</label>
                                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter New Password" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="password_confirmation">Confirm New Password</label>
                                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm New Password" required>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label for="photo">Photo</label>
                                            <input type="file" name="photo" class="form-control" id="imagee">
                                        </div>
                                        <div class="col-md-6 d-flex align-items-center">
                                            <img id="displayimage" class="wd-80 rounded-circle" width="110" src="{{ $user->photo ? url('upload/user_images/'.$user->photo) : url('upload/no_image.jpg') }}" alt="profile">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>
                            <!-- /.form -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col -->
                </div>
                <!-- /.row -->
            </div>
           
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Image preview script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#imagee').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#displayimage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
    <!-- End image preview script -->

@endsection

