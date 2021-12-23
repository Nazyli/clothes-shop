@extends('layouts.app')

@section('css')
    <style>
        .item-size {
            border-radius: 15%;
            margin-right: 4px;
            background: #fff;
            border: 1px solid #feca57;
            color: #feca57;
            font-size: 12px;
            text-align: center;
            align-items: center;
            display: flex;
            justify-content: center
        }

    </style>
@endsection()
@section('content')

    <section id="portfolio-details" class="portfolio-details">
        <div class="container">

            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Detail Product</h2>
                    <div class="d-flex">

                        <h3 class="text-left">{{ $goods->goods_name }} - <span>@currency($goods->minPrice())</span></h3>

                    </div>
                </div> 

                <div class="row gy-4">

                    <div class="col-lg-8">
                        <div class="portfolio-details-slider swiper">
                            <div class="swiper-wrapper align-items-center" style="max-height :400px">
                                @foreach ($goods->masterFileUploads as $key => $value)
                                    <div class="swiper-slide">
                                        <img src="{{ $value->pathImg() }}" class="img-fluid mb-2 rounded mx-auto d-block"
                                            alt="">
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="portfolio-info row">
                            <h3>{{ $goods->goods_name }}</h3>
                            <div class="portfolio-description col-12">
                                <h2>Description :</h2>
                                <p>
                                    {{ $goods->description }}
                                </p>
                            </div>
                            <div class="col-12 mt-2 d-flex justify-content-between">
                                <strong>Category</strong> {{ $goods->category->name }}

                            </div>
                            <div class="col-12 mt-2 d-flex justify-content-between">
                                <strong>Price</strong><strong style="color:#ff9f43; font-weight:bold;">
                                    @currency($goods->minPrice())
                                </strong>
                            </div>
                            <div class="col-12 mt-2">
                                <strong>Color</strong>
                                <div class="mt-1 d-flex flex-wrap">
                                    @foreach ($goods->goodsColors as $key => $color)
                                        <input class="item-size btn btn-outline-orange btn-sm mb-2" type="button"
                                            value="{{ $color->color }}">
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-12 mt-2">
                                <strong>Size :</strong>
                                <div class="product-detail-container p-2">
                                    <div class="d-sm-inline-flex flex-wrap">
                                        @foreach ($goods->getReadySize() as $size)
                                            <input class="item-size btn btn-outline-orange btn-sm col-sm mb-2" type="button"
                                                value="{{ $size->size }}">
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <button class="btn btn-orange btn-sm" style="color:white">
                                    <i class="fa fa-shopping-cart"></i>
                                    Buy Now
                                </button>
                                <button class="btn btn-outline-orange btn-sm">
                                    <i class="fa fa-cart-plus"></i>
                                    Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

@endsection
@section('js')
@endsection()
