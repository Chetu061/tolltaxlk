@extends('master.backendmaster')

@section('content')

<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Toll </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Toll </li>
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
                                <h3 class="card-title">Toll Edit </h3>
                            </div>

                            <form action="{{ route('toll.update', $toll->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                                <label for="carno">Enter Car Number</label>
                                                <input type="text" class="form-control" id="carno" name="carno" placeholder="Enter Car Number" value="{{ old('carno', $toll->carno) }}">
                                                @if ($errors->has('carno'))
                                                    <div class="error text-danger">{{ $errors->first('carno') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-6">
                                                <label for="aadhar">Enter Driver Aadhar</label>
                                                <input type="text" class="form-control" id="aadhar" name="aadhar" placeholder="Enter Driver Aadhar" value="{{ old('aadhar', $toll->aadhar) }}">
                                                @if ($errors->has('aadhar'))
                                                    <div class="error text-danger">{{ $errors->first('aadhar') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                                <label for="intime">Enter In Time</label>
                                                <input type="time" class="form-control" id="intime" name="intime" placeholder="Enter In Time" value="{{ old('intime', $toll->intime) }}">
                                                @if ($errors->has('intime'))
                                                    <div class="error text-danger">{{ $errors->first('intime') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <label for="outtime">Enter Out Time</label>
                                                <input type="time" class="form-control" id="outtime" name="outtime" placeholder="Enter Out Time" value="{{ old('outtime', $toll->outtime) }}">
                                                @if ($errors->has('outtime'))
                                                    <div class="error text-danger">{{ $errors->first('outtime') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                                <label for="from">Enter Location From</label>
                                                <select name="from" class="form-control">
                                                    @foreach($location as $c)
                                                        <option value="{{ $c->id }}" {{ old('from', $toll->from) == $c->id ? 'selected' : '' }}>{{ $c->city }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('from'))
                                                    <div class="error text-danger">{{ $errors->first('from') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-6">
                                                <label for="to">Enter Location To</label>
                                                <select name="to" class="form-control">
                                                    @foreach($location as $c)
                                                        <option value="{{ $c->id }}" {{ old('to', $toll->to) == $c->id ? 'selected' : '' }}>{{ $c->city }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('to'))
                                                    <div class="error text-danger">{{ $errors->first('to') }}</div>
                                                @endif
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
                    <option value="{{ $c->axel_no }}" {{ old('axeid') == $c->axel_no ? 'selected' : '' }} data-id="{{ $c->id }}">
                        {{ $c->axel_no }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('axeid'))
                <div class="error text-danger">{{ $errors->first('axeid') }}</div>
            @endif
        </div>
        <div class="col-6">
            <label for="totaltax">Total Tax</label>
            <input type="text" class="form-control" id="tax" name="total_tax" 
                   placeholder="Total Tax" 
                   value="{{ old('total_tax') }}" readonly>
            @if ($errors->has('total_tax'))
                <div class="error text-danger">{{ $errors->first('total_tax') }}</div>
            @endif
        </div>
    </div>
</div>


                                    <div class="card-footer" style="display: flex; justify-content: center;">
    <button type="submit" class="btn btn-primary">Update</button>
</div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
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
