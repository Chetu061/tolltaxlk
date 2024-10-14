@extends('master.backendmaster')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Location View</h1>
                        <a href="{{route('backend.location.create')}}"><button class="btn btn-warning">Add Location</button></a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Location View</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <!-- /.row -->
                <div class="row">
                    <div class="col">
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                @if ($location->isNotEmpty())
                                    <table class="table table-hover text-nowrap" id="example1">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Location</th>
                                               
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php $counter = 1; @endphp
                                            @foreach ($location as $v)
                                                <tr>
                                                    <td>{{ $counter++ }}</td>
                                                    <td>{{ $v->city }}</td>
                                                   
                                                    <td>
                                                        <a href="{{ route('backend.location.edit', $v->id) }}"> <button
                                                                class="bg-success border border-none">Edit</button></a>
                                                        <button class="bg-danger border border-none">
                                                            <a id="delete" href="{{ route('location.delete', $v->id) }}">Delete
                                                            </a></button>
                                                    </td>

                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                @else
                                    <p class="text-danger text-center">No Record Found</p>
                                @endif
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->

                <!-- /.row -->

                <!-- /.row -->

                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
