
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
                        <h1>Add Toll</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add Toll</li>
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
                                <h3 class="card-title">Toll Add</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="myForm" action="{{ route('toll.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="carno">Enter Car Number</label>
                                                <input type="text" class="form-control" placeholder="Enter Car Number" name="carno" required>
                                                @if ($errors->has('carno'))
                                                    <div class="error text-danger">{{ $errors->first('carno') }}</div>
                                                @endif
                                            </div>

                                            <div class="col-6">
                                                <label for="aadhar">Enter Driver Aadhar</label>
                                                <input type="text" class="form-control" placeholder="Enter Driver Aadhar" name="aadhar" required>
                                                @if ($errors->has('aadhar'))
                                                    <div class="error text-danger">{{ $errors->first('aadhar') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="intime">Enter In Time</label>
                                                <input type="time" class="form-control" name="intime" required>
                                                @if ($errors->has('intime'))
                                                    <div class="error text-danger">{{ $errors->first('intime') }}</div>
                                                @endif
                                            </div>

                                            <div class="col-6">
                                                <label for="outtime">Enter Out Time</label>
                                                <input type="time" class="form-control" name="outtime" required>
                                                @if ($errors->has('outtime'))
                                                    <div class="error text-danger">{{ $errors->first('outtime') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="from">Enter Location From</label>
                                                <select name="from" id="input1" class="form-control" required>
                                                    @foreach($location as $c)
                                                        <option value="{{ $c->id }}">{{ $c->city }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('from'))
                                                    <div class="error text-danger">{{ $errors->first('from') }}</div>
                                                @endif
                                            </div>

                                            <div class="col-6">
                                                <label for="to">Enter Location To</label>
                                                <select name="to" id="input2" class="form-control" required>
                                                    @foreach($location as $c)
                                                        <option value="{{ $c->id }}">{{ $c->city }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('to'))
                                                    <div class="error text-danger">{{ $errors->first('to') }}</div>
                                                @endif

                                                <!-- Error message for JavaScript validation -->
                                                <div id="errorMessage" class="text-danger mt-2" style="display:none;"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
    <div class="row">
        <div class="col-6">
            <label for="axeid">Select Axel Number</label>
            <select name="axeid" id="axeid" class="form-control" required>
                <option value="">Select Axel Number</option>
                @foreach($newtoll as $c)
                    <option value="{{ $c->axel_no }}" data-id="{{ $c->id }}">{{ $c->axel_no }}</option>
                @endforeach
            </select>
            @if ($errors->has('axeid'))
                <div class="error text-danger">{{ $errors->first('axeid') }}</div>
            @endif
        </div>
        <div class="col-6">
            <label for="totaltax">Total Tax</label>
            <input type="text" class="form-control" id="tax" name="total_tax" placeholder="Total Tax" readonly>
            @if ($errors->has('totaltax'))
                <div class="error text-danger">{{ $errors->first('totaltax') }}</div>
            @endif
        </div>
    </div>
</div>

                                
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('myForm');
    const input1 = document.getElementById('input1');
    const input2 = document.getElementById('input2');
    const errorMessage = document.getElementById('errorMessage');
    const distanceInput = document.getElementById('distance');

    form.addEventListener('submit', function(event) {
        // Clear previous error message
        errorMessage.style.display = 'none';
        errorMessage.textContent = '';

        // Validate if Location From and To are the same
        if (input1.value === input2.value) {
            event.preventDefault();
            // Show the error message
            errorMessage.style.display = 'block';
            errorMessage.textContent = 'Location From and Location To cannot be the same!';
        }
    });

    // Calculate distance on change of location selection
    input1.addEventListener('change', calculateDistance);
    input2.addEventListener('change', calculateDistance);

    function calculateDistance() {
        const fromId = input1.value;
        const toId = input2.value;

        // Example of an AJAX call to fetch distance based on selected locations
        fetch(`/get-distance?from=${fromId}&to=${toId}`)
            .then(response => response.json())
            .then(data => {
                if (data.distance !== undefined) {
                    distanceInput.value = data.distance; // Set distance value from response
                } else {
                    distanceInput.value = '';
                }
            })
            .catch(error => {
                console.error('Error fetching distance:', error);
                distanceInput.value = ''; // Reset distance on error
            });
    }

    // Clear the error message as soon as the user starts selecting new values
    input1.addEventListener('change', function() {
        errorMessage.style.display = 'none';
    });

    input2.addEventListener('change', function() {
        errorMessage.style.display = 'none';
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const axeSelect = document.getElementById('axeid');
    const taxInput = document.getElementById('tax');

    axeSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex]; // Get the selected option
        const selectedId = selectedOption.getAttribute('data-id'); // Get the data-id attribute

        if (selectedId) {
            // Perform AJAX request to get total tax using selectedId
            fetch(`/get-tax/${selectedId}`) // Adjust the URL according to your route
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        taxInput.value = data.total; // Set the total tax in the input field
                    } else {
                        taxInput.value = ''; // Clear if no tax found
                    }
                })
                .catch(error => {
                    console.error('Error fetching total tax:', error);
                    taxInput.value = ''; // Reset tax field on error
                });
        } else {
            taxInput.value = ''; // Clear the field if no selection
        }
    });
});
</script>
@endsection
