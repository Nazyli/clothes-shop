@extends('user.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Address</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('address.index') }}">My Address </a></li>
                            <li class="breadcrumb-item active"><a href="#">Add Address </a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row  p-2">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Form Data</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('address.update', $address->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="address_name"><strong>Address Name</strong></label>
                                        <input type="text"
                                            class="form-control form-control-border @error('address_name') is-invalid @enderror"
                                            id="address_name" name="address_name"
                                            value="{{ $address->address_name }}">
                                        @error('address_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="full_address"><strong>Full Address</strong></label>
                                        <textarea class="form-control @error('full_address') is-invalid @enderror" rows="3"
                                            placeholder="Full Address"
                                            name="full_address">{{ $address->full_address }}</textarea>

                                        @error('full_address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="zip_code"><strong>ZIP Code</strong></label>
                                        <input type="text"
                                            class="form-control form-control-border @error('zip_code') is-invalid @enderror"
                                            id="zip_code" name="zip_code" value="{{ $address->zip_code }}">
                                        @error('zip_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="lat"><strong>Latitude</strong></label>
                                        <input type="text"
                                            class="form-control form-control-border @error('lat') is-invalid @enderror"
                                            id="lat" name="lat" value="{{ $address->lat }}">
                                        @error('lat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="long"><strong>Longitude</strong></label>
                                        <input type="text"
                                            class="form-control form-control-border @error('long') is-invalid @enderror"
                                            id="long" name="long" value="{{ $address->long }}">
                                        @error('long')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input name="is_main" type="checkbox" class="custom-control-input" {{ $address->is_main ? 'checked' : '' }} id="is_main">
                                            <label class="custom-control-label" for="is_main"> Main Address</label>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary btn-block"><b>Save</b></button>
                                    <a href="{{ route('address.index') }}"
                                        class="btn btn-secondary btn-block"><b>Cancel</b></a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
