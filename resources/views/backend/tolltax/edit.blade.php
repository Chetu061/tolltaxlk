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
                                        <div class="col-md-6 col-sm-12">
                                                <label for="axeid">Enter AXE Number</label>
                                                <select name="axeid" class="form-control">
                                                    @foreach($axe as $c)
                                                        <option value="{{ $c->id }}" {{ old('axeid', $toll->axeid) == $c->id ? 'selected' : '' }}>{{ $c->axelno }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('axeid'))
                                                    <div class="error text-danger">{{ $errors->first('axeid') }}</div>
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

@endsection
