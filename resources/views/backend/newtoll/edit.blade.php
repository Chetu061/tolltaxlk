@extends('master.backendmaster')

@section('content')

<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Toll Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Toll</li>
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
                                <h3 class="card-title">Edit Toll Details</h3>
                            </div>

                            <!-- Form Start -->
                            <form action="{{ route('newtoll.update', $toll->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12">
                                                <label for="from">From</label>
                                                <select name="from" class="form-control">
                                                    @foreach($location as $c)
                                                        <option value="{{ $c->id }}" {{ $toll->from == $c->id ? 'selected' : '' }}>{{ $c->city }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <label for="to">To</label>
                                                <select name="to" class="form-control">
                                                    @foreach($location as $c)
                                                        <option value="{{ $c->id }}" {{ $toll->to == $c->id ? 'selected' : '' }}>{{ $c->city }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <label for="axel_no">Axel No</label>
                                                <select name="axel_no" class="form-control">
                                                    @foreach($axe as $c)
                                                       <option value="{{ $c->axelno }}" {{ $toll->axel_no == $c->id ? 'selected' : '' }}>{{ $c->axelno }}</option> 
                                
                                                    @endforeach
                                                </select>  
                                                @if ($errors->has('axel_no'))
                <div class="error text-danger">{{ $errors->first('axel_no') }}</div>
            @endif 
                                            </div>
                                        </div>
                                    </div>

                                    <div id="tollSection">
                                        @foreach ($toll->relatedtoll as $index => $relatedToll)
                                            <div class="form-group toll-entry">
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-12">
                                                        <label for="tollname">Toll Name</label>
                                                        <input type="text" name="relatedtoll[{{ $index }}][tollname]" class="form-control" value="{{ $relatedToll->tollname }}" required>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12">
                                                        <label for="price">Price</label>
                                                        <input type="number" name="relatedtoll[{{ $index }}][price]" class="form-control price" value="{{ $relatedToll->price }}" required>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12">
                                                        <button type="button" class="btn btn-danger mt-4 remove-toll-btn">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="form-group">
                                        <button type="button" id="addTollBtn" class="btn btn-secondary">+ Add Toll</button>
                                    </div>

                                    <div class="form-group">
                                        <label for="total">Total</label>
                                        <input type="number" id="total" name="total" class="form-control" value="{{ $toll->total }}" readonly>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update</button>
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
    let tollIndex = {{ $toll->relatedtoll->count() }};

    // Add new toll entry
    document.getElementById('addTollBtn').addEventListener('click', function() {
        const tollSection = document.getElementById('tollSection');
        const tollFields = `
            <div class="form-group toll-entry">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <label for="tollname">Toll Name</label>
                        <input type="text" name="relatedtoll[${tollIndex}][tollname]" class="form-control" required>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="price">Price</label>
                        <input type="number" name="relatedtoll[${tollIndex}][price]" class="form-control price" required>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <button type="button" class="btn btn-danger mt-4 remove-toll-btn">Remove</button>
                    </div>
                </div>
            </div>
        `;
        tollSection.insertAdjacentHTML('beforeend', tollFields);
        tollIndex++;
        attachRemoveButtons();
    });

    // Update total price dynamically
    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('price')) {
            const prices = document.querySelectorAll('.price');
            let total = 0;
            prices.forEach(price => total += parseFloat(price.value) || 0);
            document.getElementById('total').value = total;
        }
    });

    // Remove toll entry
    function attachRemoveButtons() {
        const removeButtons = document.querySelectorAll('.remove-toll-btn');
        removeButtons.forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.toll-entry').remove();
                updateTotal();
            });
        });
    }

    // Update total after removing toll
    function updateTotal() {
        const prices = document.querySelectorAll('.price');
        let total = 0;
        prices.forEach(price => total += parseFloat(price.value) || 0);
        document.getElementById('total').value = total;
    }

    // Attach remove buttons on page load
    attachRemoveButtons();
</script>

@endsection
