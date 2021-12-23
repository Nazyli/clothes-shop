@extends('layouts.app')

@section('css')
    <style>
        .card {
            background-color: #fff;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
        }

        .image-container {
            position: relative
        }

        .thumbnail-image {
            border-radius: 10px !important
        }

        .discount {
            background-color: #ffbe76;
            padding-top: 1px;
            padding-bottom: 1px;
            padding-left: 4px;
            padding-right: 4px;
            font-size: 10px;
            border-radius: 6px;
            color: #fff font-weight: bold;
        }

        .wishlist {
            height: 25px;
            width: 25px;
            background-color: #eee;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
        }

        .first {
            position: absolute;
            width: 100%;
            padding: 9px
        }

        .dress-name {
            font-size: 12px;
            font-weight: bold;
        }

        .product-description {
            font-size: 10px;
            color: #7f8c8d;
        }

        .new-price {
            font-size: 14px;
            font-weight: bolder;
            color: #ff9f43;
        }

        .old-price {
            font-size: 10px;
            font-weight: bold;
            color: grey
        }


        .voutchers {
            background-color: #fff;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            overflow: hidden
        }

        .voutcher-divider {
            display: flex
        }

        .voutcher-left {
            width: 60%
        }

        .voutcher-name {
            color: grey;
            font-size: 9px;
            font-weight: 500
        }

        .voutcher-code {
            color: red;
            font-size: 11px;
            font-weight: bold
        }

        .voutcher-right {
            width: 40%;
            background-color: purple;
            color: #fff
        }

        .discount-percent {
            font-size: 12px;
            font-weight: bold;
            position: relative;
            top: 5px
        }

        .off {
            font-size: 14px;
            position: relative;
            bottom: 5px
        }

        .ribbon-wrapper {
            width: 80px;
            height: 80px;
            overflow: hidden;
            position: absolute;
            top: -3px;
            right: -3px
        }


        .btn-orange {
            color: #1f2d3d;
            background-color: #ff9f43;
            border-color: #ff9f43;
            box-shadow: none;
        }

        .btn-orange:hover {
            color: #1f2d3d;
            background-color: #ffbe76;
            border-color: #feca57;
        }

        .btn-orange:focus,
        .btn-orange.focus {
            color: #1f2d3d;
            background-color: #e0a800;
            border-color: #d39e00;
            box-shadow: 0 0 0 0 rgba(221, 171, 15, 0.5);
        }

        .btn-outline-orange {
            color: #ff9f43;
            background-color: #fff;
            border-color: #ff9f43;
            box-shadow: none;
        }

        .btn-outline-orange:hover {
            color: #fff;
            background-color: #ffbe76;
            border-color: #feca57;
        }

        .btn-outline-orange:focus,
        .btn-outline-orange.focus {
            color: #fff;
            background-color: #e0a800;
            border-color: #d39e00;
            box-shadow: 0 0 0 0 rgba(221, 171, 15, 0.5);
        }

        .btn-outline-warning:hover {}


        .ribbon {
            font-size: 12px;
            color: #FFF;
            text-transform: uppercase;
            font-family: 'Montserrat Bold', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            letter-spacing: .05em;
            line-height: 15px;
            text-align: center;
            text-shadow: 0 -1px 0 rgba(0, 0, 0, .4);
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            transform: rotate(45deg);
            position: relative;
            padding: 7px 0;
            right: -11px;
            top: 10px;
            width: 100px;
            height: 28px;
            -webkit-box-shadow: 0 0 3px rgba(0, 0, 0, .3);
            box-shadow: 0 0 3px rgba(0, 0, 0, .3);
            background-color: #dedede;
            background-image: -webkit-linear-gradient(top, #ffffff 45%, #dedede 100%);
            background-image: -o-linear-gradient(top, #ffffff 45%, #dedede 100%);
            background-image: linear-gradient(to bottom, #ffffff 45%, #dedede 100%);
            background-repeat: repeat-x;
            filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffdedede', GradientType=0)
        }

        .ribbon:before,
        .ribbon:after {
            content: "";
            border-top: 3px solid #9e9e9e;
            border-left: 3px solid transparent;
            border-right: 3px solid transparent;
            position: absolute;
            bottom: -3px
        }

        .ribbon:before {
            left: 0
        }

        .ribbon:after {
            right: 0
        }

        .ribbon.green {
            background-color: #ffbe76;
            background-image: -webkit-linear-gradient(top, #ffbe76 45%, #f0932b 100%);
            background-image: -o-linear-gradient(top, #ffbe76 45%, #f0932b 100%);
            background-image: linear-gradient(to bottom, #ffbe76 45%, #f0932b 100%);
            background-repeat: repeat-x;
            filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#ffbe76', endColorstr='#f0932b', GradientType=0)
        }

        .ribbon.green:before,
        .ribbon.green:after {
            border-top: 3px solid #f0932b;
        }



        .pagination > li > a
{
    background-color: white;
    color: #ff9f43;
}

.pagination > li > a:focus,
.pagination > li > a:hover,
.pagination > li > span:focus,
.pagination > li > span:hover
{
    color: #f0932b;
    background-color: #eee;
    border-color: #ddd;
}

.page-item.active .page-link {
    color: #fff;
    background-color: #ffbe76;
    border-color: #f0932b;
}
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
                    <div class="col-md-3 col-sm-12 mb-5">
                        <div class="card">
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

                            <div class="image-container">
                                <img src="{{ $value->masterFileUpload()->pathImg() }}"
                                    class="img-fluid rounded thumbnail-image">
                            </div>
                            <div class="product-detail-container p-2">
                                <div class="d-flex justify-content-between">
                                    <div class="col-6 align-items-center mt-1">
                                        <h5 class="dress-name">{{ $value->goods_name }}</h5>
                                    </div>
                                    <div class="col-6 d-flex flex-column align-items-end">
                                        <span class="new-price">@currency($value->base_price)</span>
                                        <span class="old-price">@currency($value->maxPrice())</small>
                                    </div>

                                </div>
                                <div class="mt-2">
                                    <p class="product-description">
                                        {{ $value->descriptionLimit(45) }}
                                    </p>
                                </div>
                            </div>
                                <div class="d-flex justify-content-between p-2">
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
                @endforeach
            </div>
            <div class="justify-content-end">{{ $goods->links('pagination.default') }}</div>
            
        </div>
    </section>

@endsection
@section('js')
@endsection()
