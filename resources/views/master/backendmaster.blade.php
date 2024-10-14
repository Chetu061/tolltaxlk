@php
use App\Models\User;
use Illuminate\Support\Facades\Auth;
$userImage = url('upload/no_image.jpg');
$userid = Auth::id();
$user = User::find($userid);

$userImage = !empty($user->photo) ? url('upload/user_images/'.$user->photo) : $userImage;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Toll Tax </title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- toaster -->
    <link rel="stylesheet" type="text/css"

        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <!-- sam datatable -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.3.0/css/rowGroup.dataTables.min.css">
    <!-- end sam datatable -->

</head>


<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Navbar -->
         
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{url('/')}}" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-user"></i>                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media d-flex align-items-center p-2">
    <img src="{{$userImage}}" alt="User Avatar" class="img-size-50 img-circle mr-3" style="width: 50px; height: 50px;">
    <div class="media-body">
        <h3 class="dropdown-item-title mb-1">
            {{$user->name}}
        </h3>
        <p class="mb-2">{{$user->email}}</p>
        <a href="{{ url('/profile/'.Auth::user()->id) }}">
            <button class="btn btn-sm btn-outline-success">Profile Update</button>
        </a>
    </div>
</div>

                            <!-- Message End -->
                        </a>
                       
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-power-off"></i>
                </a>
                  
                 
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"
                        role="button"><i class="fas fa-th-large"></i></a>
                </li>
            </ul>
       
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Toll tax</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ $userImage }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Hi {{$user->name}}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview menu-open">
                            <a href="{{ url('/dashboard') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>

                        </li>
                      
                      
                        <li class="nav-item has-treeview">
                            <a href="{{route('backend.user.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    View User
                                </p>
                            </a>

                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                                <p>
                                   Toll
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                            <li class="nav-item has-treeview">
                            <a href="{{route('backend.toll.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                             
                                <p>
                                    View Toll </p>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="{{route('backend.toll.create')}}" class="nav-link">
                              
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Add Toll
                                </p>
                            </a>
                        </li>
                              
                              
                            </ul>
                        </li> 

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                                <p>
                                   Tolls & Prices
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                            <li class="nav-item has-treeview">
                            <a href="{{route('backend.newtoll.create')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Create Tolls & Prices
                                </p>
                            </a>

                        </li>
                            <li class="nav-item has-treeview">
                            <a href="{{route('backend.newtoll.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                                <p>
                                    View Tolls & Prices
                                </p>
                            </a>

                        </li>
                              
                              
                            </ul>
                        </li> 
                      <!-- location -->

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                                <p>
                                   Location
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                            <li class="nav-item has-treeview">
                            <a href="{{route('backend.location.create')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Create Location
                                </p>
                            </a>

                        </li>
                            <li class="nav-item has-treeview">
                            <a href="{{route('backend.location.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                                <p>
                                    View Location
                                </p>
                            </a>

                        </li>
                              
                              
                            </ul>
                        </li> 
                       <!--axe  -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                   Axel
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                            <li class="nav-item has-treeview">
                            <a href="{{route('backend.axe.create')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Create  Axel
                                </p>
                            </a>

                        </li>
                                <li class="nav-item has-treeview">
                            <a href="{{route('backend.axe.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                                <p>
                                    View Axel
                                </p>
                            </a>

                        </li>
                              
                            </ul>
                        </li> 
                        <!-- <li class="nav-item has-treeview">
                            <a href="" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                    View Client
                                </p>
                            </a>

                        </li> 
                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-tree"></i>
                                <p>
Today Cases                                </p>
                            </a>
                           
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Next Day Cases
                                </p>
                            </a>
                           
                        </li>-->
                       
                       


                       
                        <!-- <li class="nav-header">MULTI LEVEL EXAMPLE</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Level 1</p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Level 1
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Level 2</p>
                                    </a>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Level 2
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Level 3</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Level 3</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Level 3</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Level 2</p>
                                    </a>
                                </li>
                            </ul>
                        </li> -->
<!-- 
                        <li class="nav-header">LABELS</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p class="text">Important</p>
                            </a>
                        </li> -->
                 
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        @yield('content')
        <footer class="main-footer">
            <strong>Copyright &copy; 2024-2025 <a href="">LK Technology</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.0.4
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <!-- priti start -->
 <!-- {{-- toaster --}} -->



<script type="text/javascript"
    src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js') }}"></script>
    @if (Session::has('message'))
<script>
    
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;

            case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;

            case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;

            case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break;
        }
</script>
@endif

 <!-- toaster end -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{asset('js/code/validate.min.js')}}"></script>
<script src="{{asset('js/code/code.js')}}"></script>

<!-- datatable -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<!-- DataTables Responsive JS -->
<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
<!-- for delete -->
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->
<!-- <script src="{{ asset('backend/assets/js/code/validate.min.js') }}"></script> -->

<script>
$(document).ready(function() {
    $('#example1').DataTable({
        responsive: true,  // Enable responsive behavior
        order: [[0, 'desc']] 
        // Specify the column index and sorting direction
    });
});
</script>
<!-- for delete -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('backend/assets/js/code/validate.min.js') }}"></script>
<!-- end -->


<script src="{{ asset('js/code/code.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

    <!-- PAGE SCRIPTS -->
    <script src="{{ asset('dist/js/pages/dashboard2.js') }}"></script>
</body>

</html>
