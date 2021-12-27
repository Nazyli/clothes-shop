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
                <div class="row">
                    <div class="col-12">
                        <div class="invoice p-3 mb-3" style="border-top: 3px solid #fd7e14;">

                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <a href="/" class="logo"><img src="{{ asset('img/logo.png') }}"
                                                class="img-fluid"></a>
                                        <small class="float-right">Date:
                                            {{ date('d/m/Y', strtotime($order->created_at)) }}</small>
                                    </h4>
                                </div>
                            </div>

                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    From
                                    <address>
                                        <strong>JOLA, App.</strong><br>
                                        Jl Jend Sudirman Kav 52-53<br>
                                        Senayan JAK, Dki Jakarta <br>
                                        Phone: +6285735906222<br>
                                        Email: jola@nazyli.com
                                    </address>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    To
                                    <address>
                                        <strong>{{ $order->user->getFullName() }}</strong><br>
                                        {{ $order->full_address }}<br>
                                        Phone: {{ $order->phone }}<br>
                                        Email: {{ $order->email }}
                                    </address>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <b class="text-primary">Invoice
                                        #{{ $order->id . date('Ymd', strtotime($order->created_at)) }}</b><br>
                                    <br>
                                    <b>Order ID:</b> {{ $order->id }}<br>
                                    <b>No Receipt:</b> {{ $order->no_resi }}<br>
                                    <b>Status:</b> <label
                                        class="{{ $order->is_confirm ? 'text-success' : 'text-danger' }}">{{ $order->is_confirm ? 'PAID' : 'NEED CONFIRM' }}</label>
                                </div>
                            </div>

                            <div class="product-details-cart mr-2 mb-2">
                                @foreach ($order->orderDetails as $key => $value)
                                    <div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
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

                            <div class="row">

                                <div class="col-6">
                                    <p class="lead">Payment Methods:</p>
                                    <img src="{{ $order->pathImg() }}" alt="Visa" style="max-height :80px">

                                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                        {{ $order->paymentMethod()->name }}
                                    </p>
                                </div>
                                <div class="col-6">
                                    <p class="lead">Amount Due :</p>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width:50%">Subtotal:</th>
                                                <td>@currency($order->total_price)</td>
                                            </tr>
                                            <tr>
                                                <th>Tax</th>
                                                <td>@currency(0)</td>
                                            </tr>
                                            <tr>
                                                <th>Shipping:</th>
                                                <td>@currency(0)</td>
                                            </tr>
                                            <tr>
                                                <th>Total:</th>
                                                <td>@currency($order->total_price)</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row no-print">
                                <div class="col-12">
                                    <button rel="noopener noreferrer" onclick="form_print()" target="_blank"
                                        class="btn btn-default"><i class="fas fa-print"></i> Print</button>
                                    {{-- <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-download"></i> Generate PDF
                                    </button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>


@endsection
@section('js')
    <script>
        function form_print() {
            window.addEventListener("load", window.print());
        }
    </script>
@endsection
