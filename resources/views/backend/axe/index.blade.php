@extends('master.backendmaster')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"style="display: flex; justify-content: center;">
                    <h1>Axel View</h1>
                    <a href="{{ route('backend.axe.create') }}">
                        <button class="btn btn-warning">Add Axel</button>
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Axel View</li>
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

                        <div class="card-body table-responsive p-0">
                            @if ($axes->isNotEmpty())
                                <table class="table table-hover text-nowrap" id="example1">
                                    <thead>
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Axel Number</th>
                                            <th>Tax Rate</th> <!-- Added Tax Rate Column -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 1; @endphp
                                        @foreach ($axes as $v)
                                            <tr>
                                                <td>{{ $counter++ }}</td>
                                                <td>{{ $v->axelno }}</td>
                                                <td>{{ $v->tax_rate }}</td> <!-- Display Tax Rate -->
                                                <td>
                                                    <a href="{{ route('backend.axe.edit', $v->id) }}">
                                                        <button class="bg-success border border-none">Edit</button>
                                                    </a>
                                                    <button class="bg-danger border border-none">
                                                        <a id="delete" href="{{ route('axe.delete', $v->id) }}">Delete</a>
                                                    </button>
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

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
