@extends('user.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Order Confirmation <label class="text-primary"> ID#{{ $order->id }} </label> </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Order Confirmation </a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('transaction.send-order', $order->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="row">
                        <div class="card card-orange card-outline col-12">
                            <div class="card-header">
                                <h3 class="card-title">Detail Orders <label class="text-primary">
                                        ID#{{ $order->id }}
                                    </label></h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="product-details-cart mr-2">
                                    <h6 class="mb-0">Purchased items</h6>
                                    <div class="d-flex justify-content-between"><span>You have
                                            {{ count($order->orderDetails) }} items in your cart</span>
                                        <div class="d-flex flex-row align-items-center"><span class="text-black-50">Sort
                                                by:</span>
                                            <div class="price ml-2"><span class="mr-1">price</span><i
                                                    class="fa fa-angle-down"></i></div>
                                        </div>
                                    </div>
                                    @foreach ($order->orderDetails as $key => $value)
                                        <div
                                            class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
                                            <div class="d-flex flex-row"><img class="rounded"
                                                    src="{{ $value->goods()->masterFileUpload()->pathImg() }}" width="60">
                                                <div class="ml-2">
                                                    <span class="font-weight-bold d-block"> <a
                                                            href="{{ route('products.detail', $value->goods_id) }}">{{ $value->goods_name }}</a></span>
                                                    <span class="spec d-block">{{ $value->color }},
                                                        {{ $value->size }}</span>
                                                    <span class="spec d-inline-block text-truncate"
                                                        style="max-width: 120px;">{{ $value->goods()->description }}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row align-items-center">
                                                <span class="d-block">{{ $value->qty }}</span>
                                                <span
                                                    class="d-block ml-5 text-center font-weight-bold text-orange">@currency($value->total_price)</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="card col-12" style="border-bottom: 3px solid #fd7e14;">
                            <div class="card-header">
                                <h3 class="card-title">Shipping and Payment</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="first_name"><strong>First Name</strong></label>
                                                <input type="text"
                                                    class="form-control form-control-sm rounded-0 @error('first_name') is-invalid @enderror"
                                                    id="first_name" name="first_name"
                                                    value="{{ old('first_name') == null ? Auth::user()->first_name : old('first_name') }}">
                                                @error('first_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="last_name"><strong>Last Name</strong></label>
                                                <input type="text"
                                                    class="form-control form-control-sm rounded-0 @error('last_name') is-invalid @enderror"
                                                    id="last_name" name="last_name"
                                                    value="{{ old('last_name') == null ? Auth::user()->last_name : old('last_name') }}">
                                                @error('last_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="exampleInputBorder"><strong>Address</strong>
                                                </label>
                                                <div class="input-group input-group-sm">
                                                    <select
                                                        class="custom-select rounded-0 @error('address_id') is-invalid @enderror"
                                                        name="address_id">
                                                        <option disabled selected value></option>
                                                        @foreach ($address as $key => $value)
                                                            <option value="{{ $value->id }}"
                                                                {{ old('address_id') == $value->id ? 'selected' : '' }}>
                                                                {{ $value->address_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="input-group-append">
                                                        <a href="{{ route('address.create') }}"
                                                            class="btn btn-outline-primary btn-flat btn-xs">
                                                            <i class="fas fa-plus"> </i> New</a>
                                                    </span>
                                                    @error('address_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="form-group col-6">
                                                <label for="zip_code"><strong>ZIP Code</strong></label>
                                                <input type="text"
                                                    class="form-control form-control-sm rounded-0 @error('zip_code') is-invalid @enderror"
                                                    id="zip_code" name="zip_code" value="{{ old('zip_code') }}">
                                                @error('zip_code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="full_address"><strong>Full Address</strong></label>
                                            <textarea
                                                class="form-control form-control-sm @error('full_address') is-invalid @enderror"
                                                rows="1" name="full_address">{{ old('full_address') }}</textarea>

                                            @error('full_address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>



                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="lat"><strong>Latitude</strong></label>
                                                <input type="text"
                                                    class="form-control form-control-sm rounded-0 @error('lat') is-invalid @enderror"
                                                    id="lat" name="lat" value="{{ old('lat') }}">
                                                @error('lat')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="long"><strong>Longitude</strong></label>
                                                <input type="text"
                                                    class="form-control form-control-sm rounded-0 @error('long') is-invalid @enderror"
                                                    id="long" name="long" value="{{ old('long') }}">
                                                @error('long')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="phone"><strong>Phone</strong></label>
                                                <input type="text"
                                                    class="form-control form-control-sm rounded-0 @error('phone') is-invalid @enderror"
                                                    id="phone" name="phone"
                                                    value="{{ old('phone') == null ? Auth::user()->phone : old('phone') }}">
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="email"><strong>Email</strong></label>
                                                <input type="email"
                                                    class="form-control form-control-sm rounded-0 @error('email') is-invalid @enderror"
                                                    id="email" name="email"
                                                    value="{{ old('email') == null ? Auth::user()->email : old('email') }}">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="payments_id"><strong>Payment Method</strong></label>
                                            <select
                                                class="form-control form-control-sm rounded-0 @error('payments_id') is-invalid @enderror"
                                                name="payments_id">
                                                @foreach ($payment as $key => $value)
                                                    <option value="{{ $value->id }}"
                                                        {{ old('payments_id') == $value->id ? 'selected' : '' }}>
                                                        {{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('address_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="url_evidence_transfer">Evidence Transfer</label>
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('url_evidence_transfer') is-invalid @enderror"
                                                    id="url_evidence_transfer" name="url_evidence_transfer">
                                                <label class="custom-file-label" for="url_evidence_transfer">Upload
                                                    file</label>
                                                @error('url_evidence_transfer')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <hr>
                                <div class="d-flex justify-content-between row">
                                    <div class="col-6">
                                        <h4 class="font-weight-bold text-secondary">
                                            Total:
                                        </h4>
                                    </div>
                                    <div class="col-6 text-right">
                                        <h4 class="font-weight-bold text-orange">
                                            @currency($order->total_price)
                                        </h4>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end row mt-5">
                                    <div class="col-6 text-right">
                                        <button class="btn btn-outline-primary btn-lg" style="width: 150px"><b>
                                                Send Order &nbsp;&nbsp;&nbsp; <i class="fas fa-paper-plane">
                                                </i></b></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </section>
    </div>
@endsection
@section('js')
    <script>
        $('select[name="address_id"]').on('change', function() {
            let id = $(this).val();
            let url = "{{ route('address.show', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('textarea[name="full_address"]').text(data.full_address);
                    $('input[name="zip_code"]').val(data.zip_code);
                    $('input[name="lat"]').val(data.lat);
                    $('input[name="long"]').val(data.long);
                }
            });
        });
    </script>
@endsection
