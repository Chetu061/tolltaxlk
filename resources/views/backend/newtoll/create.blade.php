@extends('master.backendmaster')

@section('content')

<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add New Toll</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add New Toll</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">New Toll Add</h3>
                            </div>

                            <!-- Form Start -->
                            <form id="tollForm" action="{{route('newtoll.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12">
                                                <label for="from">From</label>
                                                <select name="from" id="inputFrom" class="form-control" required>
                                                    @foreach($location as $c)
                                                        <option value="{{ $c->id }}">{{ $c->city }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <label for="to">To</label>
                                                <select name="to" id="inputTo" class="form-control" required>
                                                    @foreach($location as $c)
                                                        <option value="{{ $c->id }}">{{ $c->city }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <label for="axel_no">Axel No</label>
                                                <select name="axel_no" class="form-control" required>
                                                    @foreach($axe as $c)
                                                        <option value="{{ $c->axelno }}">{{ $c->axelno }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('axel_no'))
                <div class="error text-danger">{{ $errors->first('axel_no') }}</div>
            @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div id="tollSection">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-12">
                                                    <label for="tollname">Toll Name</label>
                                                    <input type="text" name="tolls[0][tollname]" class="form-control" required>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <label for="price">Price</label>
                                                    <input type="number" name="tolls[0][price]" class="form-control price" required>
                                                </div>
                                                <div class="col-md-4 col-sm-12"><br>
                                                    <button type="button" id="addTollBtn" class="btn btn-secondary">+ Add Toll</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="total">Total</label>
                                        <input type="number" id="total" name="total" class="form-control" readonly>
                                    </div>

                                    <div id="errorMessage" class="text-danger mb-3" style="display: none;"></div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- Add Toll Script -->
<script>
    let tollIndex = 1;

    // Function to add new toll input fields
    document.getElementById('addTollBtn').addEventListener('click', function() {
        const tollSection = document.getElementById('tollSection');
        const tollFields = `
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <label for="tollname">Toll Name</label>
                        <input type="text" name="tolls[${tollIndex}][tollname]" class="form-control" required>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="price">Price</label>
                        <input type="number" name="tolls[${tollIndex}][price]" class="form-control price" required>
                    </div>
                </div>
            </div>
        `;
        tollSection.insertAdjacentHTML('beforeend', tollFields);
        tollIndex++;
    });

    // Function to calculate total price dynamically
    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('price')) {
            const prices = document.querySelectorAll('.price');
            let total = 0;
            prices.forEach(price => {
                total += parseFloat(price.value) || 0;
            });
            document.getElementById('total').value = total;
        }
    });

    // Function to validate the "From" and "To" fields
    document.getElementById('tollForm').addEventListener('submit', function(event) {
        const fromLocation = document.getElementById('inputFrom').value;
        const toLocation = document.getElementById('inputTo').value;
        const errorMessage = document.getElementById('errorMessage');

        if (fromLocation === toLocation) {
            // Prevent form submission if "From" and "To" locations are the same
            event.preventDefault();
            errorMessage.style.display = 'block';
            errorMessage.textContent = 'The "From" and "To" locations cannot be the same!';
        } else {
            errorMessage.style.display = 'none';
        }
    });
</script>

@endsection
