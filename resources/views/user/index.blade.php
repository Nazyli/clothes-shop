@extends('user.layouts.app')

@php
$totalCart = App\Models\Cart::where('user_id', Auth::user()->id)
    ->get()
    ->count();
$pending = App\Models\Orders::whereNull('url_evidence_transfer')
    ->where('user_id', Auth::user()->id)
    ->orderBy('created_at', 'DESC')
    ->get()
    ->count();
$waiting = App\Models\Orders::whereNotNull('url_evidence_transfer')
    ->where('user_id', Auth::user()->id)
    ->whereNull('is_confirm')
    ->orderBy('created_at', 'DESC')
    ->get()
    ->count();
$history = App\Models\Orders::where('user_id', Auth::user()->id)
    ->whereNotNull('is_confirm')
    ->orderBy('created_at', 'DESC')
    ->get()
    ->count();
@endphp
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="text-navy">Welcome Back</h1>
                        <h6 class="mt-2 text-primary"> <i class="fas fa-user mr-2"></i>  {{ Auth::user()->getFullName() }} 
                        </h6>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">User</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-orange">
                            <span class="info-box-icon"><i class="fas fa-cart-arrow-down text-light"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text text-light">Shopping Cart</span>
                                <span class="info-box-number text-light">
                                    {{ $totalCart }} Data
                                </span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <a href="{{ url('user/cart') }}" class="text-light">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-maroon disabled">
                            <span class="info-box-icon"><i class="fas fa-clock"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Pending Transaction</span>
                                <span class="info-box-number">
                                    {{ $pending }} Data
                                </span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                    <a href="{{ url('user/pending') }}" class="text-light">
                                        More info <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-primary">
                            <span class="info-box-icon"><i class="fas fa-spinner"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Waiting Confirmation</span>
                                <span class="info-box-number">
                                    {{ $waiting }} Data
                                </span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <a href="{{ url('user/waiting') }}" class="text-light">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-teal">
                            <span class="info-box-icon"><i class="fas fa-receipt"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Purchase History</span>
                                <span class="info-box-number">
                                    {{ $history }} Data
                                </span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <a href="{{ url('user/purchase/history') }}" class="text-light">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><b> Catalog Picture </b></h3>
                            <div class="card-tools">
                                <a href="{{ route('products') }}" class="btn btn-primary btn-xs"><b> Show All </b>
                                </a>

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
                                @foreach (App\Models\Goods::where('is_active', TRUE)->inRandomOrder()->limit(16)->get() as $key => $value)
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <a href="{{ $value->masterFileUpload()->pathImg() }}" data-toggle="lightbox"
                                            data-title="<a href='{{ route('products.detail', $value->id) }}' >{{ $value->goods_name }}</a>"
                                            data-gallery="gallery">
                                            <img src="{{ $value->masterFileUpload()->pathImg() }}"
                                                class="img-fluid mb-2 rounded mx-auto d-block" style="max-height :83px"
                                                alt="{{ $value->goods_name }}" />
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
