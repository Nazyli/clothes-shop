@extends('layouts.app')

@section('css')
    <style>
    </style>
@endsection()
@section('content')


    <section id="catalog" class="catalog section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>CATALOG</h2>
                <div class="d-flex">

                    <h3 class="text-left">Catalog Collection <span>Product</span></h3>

                </div>
            </div>

            <div class="row">
                @foreach ($goods as $key => $value)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-5">
                        <div class="card">
                            <a href="{{ route('products.detail', $value->id) }}">

                                @php
                                    $min10Day = Carbon\Carbon::now()->subDays(10);
                                    $startDate = \Carbon\Carbon::createFromFormat('Y-m-d', Carbon\Carbon::parse($min10Day)->format('Y-m-d'));
                                    $endDate = \Carbon\Carbon::createFromFormat('Y-m-d', Carbon\Carbon::parse($value->created_at)->format('Y-m-d'));
                                @endphp
                                @if ($startDate <= $endDate && isset($value->created_at))
                                    <div class="ribbon-wrapper">
                                        <div class="ribbon green">New</div>
                                    </div>
                                @else <span></span>
                                @endif

                                <div class="image-container ">
                                    <div class="text-center">
                                        <img src="{{ $value->masterFileUpload()->pathImg() }}"
                                            class="img-fluid rounded img-thumbnail border-0" style="height :220px">
                                    </div>
                                </div>
                                <div class="product-detail-container p-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="col-6 align-items-center mt-1">
                                            <h5 class="dress-name">{{ $value->goods_name }}</h5>
                                        </div>
                                        <div class="col-6 d-flex flex-column align-items-end">
                                            <span class="new-price">@currency($value->minPrice())</span>
                                            <span class="old-price">@currency($value->maxPrice())</small>
                                        </div>

                                    </div>
                                    <div class="mt-2">
                                        <p class="product-description">
                                            {{ $value->descriptionLimit(45) }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <div class="d-flex justify-content-between p-2">
                                <a href="{{ route('products.detail', $value->id) }}" type="button"
                                    class="btn btn-orange btn-sm" style="color:white">
                                    <i class="fa fa-info"></i>
                                    Details
                                </a>
                                <a class="btn btn-outline-orange btn-sm">
                                    <i class="fa fa-cart-plus"></i>
                                    Cart
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="justify-content-end">{{ $goods->links('pagination.default') }}</div>

        </div>
    </section>

@endsection
@section('js')
@endsection()
