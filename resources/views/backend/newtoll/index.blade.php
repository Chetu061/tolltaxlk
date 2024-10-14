@extends('master.backendmaster')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>New Toll View</h1>
                    <a href="{{ route('backend.newtoll.create') }}">
                        <button class="btn btn-warning">Add New Toll</button>
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">New Toll View</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            @if ($newtoll->isNotEmpty())
                                <table class="table table-hover text-nowrap" id="example1">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Axel No</th>
                                            <th>Total Price</th>
                                            <th>Tolls</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 1; @endphp
                                        @foreach ($newtoll as $form)
                                            <tr>
                                                <td>{{ $counter++ }}</td>
<td>{{ $form->fromLocation->city ?? 'NA' }}</td>
<td>{{ $form->toLocation->city ?? 'NA' }}</td>
<td>{{ $form->axel_no ?? 'NA' }}</td>

                                                <td>₹{{ $form->total }}</td>
                                                <td>
                                                    <ul>
                                                        @foreach ($form->relatedtoll as $toll)
                                                            <li>{{ $toll->tollname }}: ₹{{ $toll->price }} ({{ $toll->time }})</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <a href="{{ route('newtoll.pdf', $form->id) }}">
                                                        <button class="btn btn-primary btn-sm">Download PDF</button>
                                                    </a>

                                                    <a href="{{ route('backend.newtoll.edit', $form->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                                    <a id="delete" href="{{ route('newtoll.delete', $form->id) }}">
                                                        <button class="btn btn-danger btn-sm text-light">Delete</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-danger text-center">No records found.</p>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection