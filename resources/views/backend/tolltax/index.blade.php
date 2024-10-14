@extends('master.backendmaster')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Toll View</h1>
                        <a href="{{route('backend.toll.create')}}"><button class="btn btn-warning">Add Toll</button></a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Toll View</li>
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
                                @if ($toll->isNotEmpty())
                                    <table class="table table-hover text-nowrap" id="example1">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Car No.</th>
                                                <th>Driver Aadhar</th>
                                                <th>Axel No.</th>
                                                <th>In Time</th>
                                                <th>Out Time</th>
                                                <th>Location From</th>
                                                <th>Location To</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php $counter = 1; @endphp
                                            @foreach ($toll as $v)
                                                <tr>
                                                    <td>{{ $counter++ }}</td>
                                                    <td>{{ $v->carno }}</td>
                                                    <td>{{ $v->aadhar }}</td>
                                                    <td>{{ $v->axel->axelno }}</td>
                                                    <td>{{ $v->intime }}</td>
                                                    <td>{{ $v->outtime }}</td>
                                                    <td>{{ optional($v->toLocation)->city ?? 'N/A' }}</td>
<td>{{ optional($v->fromLocation)->city ?? 'N/A' }}</td>

                                                    <td>
                                                    <a href="{{ route('toll.generatePDF', $v->id) }}" class="btn btn-sm btn-primary">Download PDF</a>
                                                        <a href="{{ route('backend.toll.edit', $v->id) }}"> <button
                                                                class="bg-success border border-none">Edit</button></a>
                                                               

                                                        <button class="bg-danger border border-none">
                                                            <a id="delete" href="{{ route('toll.delete', $v->id) }}">Delete
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
