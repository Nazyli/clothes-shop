@extends('layouts.app')

@section('css')
    <style>
        .item-size {
            border-radius: 15%;
            background: #fff;
            border: 1px solid #feca57;
            color: #feca57;
            font-size: 12px;
            text-align: center;
            align-items: center;
            justify-content: center
        }

        input[type="radio"]:checked+* {
            color: #fff;
            background: #feca57;
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

                        <h3 class="text-left">{{ $goods->goods_name }} - <span>@currency($goods->minPrice())</span>
                        </h3>

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
                        <form action="{{ route('transaction.req-buy') }}" method="POST">
                            @csrf
                            <input type="hidden" name="goods_id" value="{{ $goods->id }}">

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
                                    <strong>Price</strong><strong id="price_product"
                                        style="color:#ff9f43; font-weight:bold;">
                                        @currency($goods->minPrice())
                                    </strong>
                                </div>
                                <div class="col-12 mt-2">
                                    <strong>Color</strong>
                                    <div class="mt-1 d-flex flex-wrap">
                                        @foreach ($goods->goodsColors as $key => $color)
                                            <div class="form-check p-1">
                                                <input class="form-check-input" name="color" style="display: none;"
                                                    data-id="{{ $color->id }}" data-base-price={{ $goods->base_price }}
                                                    data-additional-price={{ $color->additional_price }} type="radio"
                                                    value="{{ $color->id }}" id="color-{{ $color->id }}">
                                                <label
                                                    class="form-check-label btn btn-outline-orange btn-sm col-sm item-size"
                                                    for="color-{{ $color->id }}">
                                                    {{ $color->color }}
                                                </label>
                                            </div>
                                        @endforeach

                                    </div>
                                    @error('color')
                                        <div class="d-flex justify-content-center text-danger" style="font-size: 12px"
                                            role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="col-12 mt-2">
                                        <strong>Size :</strong>
                                        <div class="product-detail-container p-2">
                                            <div class="mt-1 d-flex flex-wrap  box-size">
                                                @foreach ($goods->getReadySize() as $size)
                                                    <div class="form-check p-1">
                                                        <input class="form-check-input" style="display: none;"
                                                            data-id="{{ $size->id }}" disabled name="size"
                                                            value="{{ $size->id }}" id="size-{{ $size->id }}"
                                                            type="radio">
                                                        <label
                                                            class="form-check-label btn btn-outline-orange btn-sm col-sm item-size"
                                                            for="size-{{ $size->id }}">
                                                            {{ $size->size }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @error('size')
                                        <div class="d-flex justify-content-center text-danger" style="font-size: 12px"
                                            role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <div class="col-12 mt-2 d-flex justify-content-between form-row align-items-center">
                                        <strong class="col-auto">Atur jumlah</strong>
                                        <div class="col-auto my-1" id="input-stok">
                                            <input type="number" class="form-control form-control-sm " style="width:80px;"
                                                name="quantity" min="1" max="5" disabled>
                                        </div>
                                        <div class="col-auto portfolio-description my-1">
                                            <p id="stok">Stok :
                                                {{ App\Models\GoodsSize::totalQty($goods->id) }}</p>
                                        </div>


                                    </div>
                                    @error('quantity')
                                        <div class="d-flex justify-content-center text-danger" style="font-size: 12px"
                                            role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <hr style="border:1px solid #f0932b;">

                                    <div class="d-flex justify-content-between">
                                        <h4>Total</h4>
                                        <h4 id="total_product" style="color:#ff9f43; font-weight:bold;">
                                            -
                                        </h4>
                                    </div>

                                    <div class="d-flex justify-content-between mt-3">
                                        <button class="btn btn-orange btn-sm" name="buy" style="color:white">
                                            <i class="fa fa-shopping-cart"></i>
                                            Buy Now
                                        </button>
                                        <button class="btn btn-outline-orange btn-sm" name="cart">
                                            <i class="fa fa-cart-plus"></i>
                                            Cart
                                        </button>
                                    </div>
                                </div>
                        </form>

                    </div>
                </div>
            </div>
    </section>
@endsection
@section('js')
    <script>
        $('input[name="color"]').on('click', function() {
            let color = $(this).val();
            let base_price = $(this).data("base-price");
            let additional_price = $(this).data("additional-price");
            let id = $(this).data("id");

            let price_product = base_price + additional_price;
            document.getElementById('price_product').innerHTML = formatRupiah(price_product);
            document.getElementById('total_product').innerHTML = "-";

            let url = "{{ route('size.bycolor', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('.box-size').empty();
                    $.each(data, function(key, value) {
                        let box_size = `
                        <div class="form-check p-1">
                            <input class="form-check-input" style="display: none;" name="size" data-id="${value.id }"  data-additional-price="${value.additional_price }"
                            value="${value.id }" data-price="${price_product}" data-qty="${value.qty }" id="size-${value.id }" type="radio">
                            <label class="form-check-label btn btn-outline-orange btn-sm col-sm item-size" for="size-${value.id }">
                                ${value.size }
                            </label>
                        </div>
                        `;
                        $('.box-size').append(box_size);
                    })

                    $('input[name="size"]').on('click', function() {
                        let price = $(this).data("price");
                        let additional_price = $(this).data("additional-price");
                        let qty = $(this).data("qty");
                        let id = $(this).data("id");

                        let price_product = price + additional_price;
                        document.getElementById('price_product').innerHTML = formatRupiah(price_product);
                        document.getElementById('stok').innerHTML = `<p id="stok">Stok : ${qty}</p>`;
                        document.getElementById('total_product').innerHTML = "-";

                        $('#input-stok').empty();
                        $('#input-stok').append(`
                            <div class="col-auto my-1" id="input-stok">
                                <input type="number" class="form-control form-control-sm" style="width:80px;" name="quantity"
                                    min="1" max="${qty}">
                            </div>`);
                        $('#input-stok').append(
                            `<input type="hidden" name="total_price" value="${price_product}">`
                        );


                        $('input[name="quantity"]').change(function() {
                            let qty = $(this).val();
                            document.getElementById('total_product').innerHTML =
                                formatRupiah(qty * price_product);
                        });

                    });
                }
            })

        });


        function formatRupiah(angka, prefix) {
            return 'Rp. ' + angka.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
        }
    </script>
@endsection()
