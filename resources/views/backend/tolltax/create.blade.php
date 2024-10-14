@extends('master.backendmaster')

@section('content')

<div class="wrapper">
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
                            <li class="breadcrumb-item active">Add Tolls and Prices</li>
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

                               

                                    <!-- Location From and Location To -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
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

                                            <div class="col-md-6 col-sm-12">
                                                <label for="to">Enter Location To</label>
                                                <select name="to" id="input2" class="form-control" required>
                                                    @foreach($location as $c)
                                                        <option value="{{ $c->id }}">{{ $c->city }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('to'))
                                                    <div class="error text-danger">{{ $errors->first('to') }}</div>
                                                @endif

                                                <div id="errorMessage" class="text-danger mt-2" style="display:none;"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Axel Number -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <label for="axeid">Enter Axel Number</label>
                                                <select name="axeid" class="form-control" required>
                                                    @foreach($axe as $c)
                                                        <option value="{{ $c->id }}">{{ $c->axelno }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('axeid'))
                                                    <div class="error text-danger">{{ $errors->first('axeid') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Toll Name and Price fields (Dynamically generated) -->
                                    <div class="form-group">
                                        <label for="tollName">Toll Name & Price</label>
                                        <div id="tollContainer">
                                            <div class="row mb-2 toll-group">
                                                <div class="col-md-6 col-sm-12">
                                                    <input type="text" class="form-control" name="tollName[]" placeholder="Enter Toll Name" required>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <input type="number" class="form-control price-input" name="price[]" placeholder="Enter Price" required>
                                                </div>
                                                <div class="col-md-2 col-sm-12">
                                                    <button type="button" class="btn btn-success add-toll">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Input for Total Price -->
                                    <div class="form-group">
                                        <label for="totalPrice">Total Price</label>
                                        <input type="text" class="form-control" id="totalPrice" name="totalPrice" readonly>
                                    </div>

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

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tollContainer = document.getElementById('tollContainer');
    const totalPriceInput = document.getElementById('totalPrice');

    // Function to add new Toll Name and Price row
    function addTollRow() {
        const tollRow = document.createElement('div');
        tollRow.classList.add('row', 'mb-2', 'toll-group');

        tollRow.innerHTML = `
            <div class="col-md-6 col-sm-12">
                <input type="text" class="form-control" name="tollName[]" placeholder="Enter Toll Name" required>
            </div>
            <div class="col-md-4 col-sm-12">
                <input type="number" class="form-control price-input" name="price[]" placeholder="Enter Price" required>
            </div>
            <div class="col-md-2 col-sm-12">
                <button type="button" class="btn btn-danger remove-toll">-</button>
            </div>
        `;

        tollContainer.appendChild(tollRow);
        calculateTotalPrice();

        // Attach event listeners to the new price input and remove button
        tollRow.querySelector('.price-input').addEventListener('input', calculateTotalPrice);
        tollRow.querySelector('.remove-toll').addEventListener('click', function() {
            tollRow.remove();
            calculateTotalPrice();
        });
    }

    // Function to calculate the total price
    function calculateTotalPrice() {
        const priceInputs = document.querySelectorAll('.price-input');
        let total = 0;

        priceInputs.forEach(function(input) {
            const value = parseFloat(input.value);
            if (!isNaN(value)) {
                total += value;
            }
        });

        totalPriceInput.value = total.toFixed(2); // Update total price field
    }

    // Event listener for the add button
    tollContainer.addEventListener('click', function(event) {
        if (event.target.classList.contains('add-toll')) {
            addTollRow();
        }
    });

    // Initial event listeners for the first toll row
    document.querySelectorAll('.price-input').forEach(function(input) {
        input.addEventListener('input', calculateTotalPrice);
    });
});
</script>

@endsection
