@extends('user.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Your Shopping Cart</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Purchase History </a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card card-orange card-outline col-12">
                        <div class="card-header">
                            <h3 class="card-title"> Check out this {{ count($carts) }} item now</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('transaction.cart-process') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="product-details-cart mr-2">
                                    <div class="mb-0 mr-2 align-self-center ">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" id="select-all"
                                                class="custom-control-input custom-control-input-orange custom-control-input-outline"
                                                type="checkbox">
                                            <label for="select-all" class="custom-control-label font-weight-normal">Select
                                                All</label>
                                        </div>
                                    </div>
                                    @foreach ($carts as $value)
                                        <div
                                            class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
                                            <div class="d-flex flex-wrap">
                                                <div class="custom-control custom-checkbox">
                                                    <input id="select-all-{{ $value->id }}" name="items_cart[]"
                                                        class="items_cart custom-control-input custom-control-input-orange custom-control-input-outline"
                                                        type="checkbox" data-price="{{ $value->price() }}"
                                                        value="{{ $value->id }} ">
                                                    <label for="select-all-{{ $value->id }}"
                                                        class="custom-control-label font-weight-normal"></label>
                                                </div>
                                                <img class="rounded"
                                                    src="{{ $value->goods()->masterFileUpload()->pathImg() }}" width="60">
                                                <div class="ml-2">
                                                    <span class="font-weight-bold d-block"> <a
                                                            href="{{ route('products.detail', $value->goods_id) }}">{{ $value->goods()->goods_name }}</a></span>
                                                    <span class="spec d-block">{{ $value->color()->color }},
                                                        {{ $value->size()->size }}</span>
                                                    <span class="spec d-inline-block text-truncate"
                                                        style="max-width: 120px;">{{ $value->goods()->description }}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row align-items-center"><span
                                                    class="d-block">{{ $value->qty }}</span><span
                                                    class="d-block ml-5 text-center font-weight-bold text-orange">@currency($value->price())</span>
                                                <form></form>
                                                <form action="{{ route('transaction.cart-destroy', $value->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-outline-danger btn-xs swalSuccesDelete ml-3"><i
                                                            class="fas fa-times fa-sm"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach

                                    <hr>
                                    <div class="d-flex justify-content-between row">
                                        <div class="col-6">
                                            <h4 class="font-weight-bold text-secondary">
                                                Total:
                                            </h4>
                                        </div>
                                        <div class="col-6 text-right">
                                            <input type="hidden" id="total-price" value="0" name="total_price">
                                            <div class="justify-content-between">
                                                <h4 class="font-weight-bold text-orange" id="total-price-show">
                                                    Rp. 0
                                                </h4>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end row mt-5">
                                        <div class="col-6 text-right">
                                            <button class="btn btn-outline-primary btn-lg"><b>
                                                    Buy &nbsp; <i class="fas fa-shopping-cart">
                                                    </i></b></button>
                                        </div>
                                    </div>

                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script>
        $('.items_cart').change(function() {
            let price = $(this).data("price");
            if (this.checked) {
                let total_price = parseInt($("#total-price").val());
                $("#total-price").val(total_price + price);
            } else {
                let total_price = parseInt($("#total-price").val());
                $("#total-price").val(total_price - price);
            }
            document.getElementById("select-all").checked = false;
            setTotalPrice($("#total-price").val());
        });

        $('#select-all').change(function(event) {
            let total_price = parseInt($("#total-price").val());
            let value = 0;
            if (this.checked) {
                $('.items_cart').each(function() {
                    this.checked = true;
                    value += $(this).data("price");
                    $("#total-price").val(value);
                });
            } else {
                $('.items_cart').each(function() {
                    this.checked = false;
                    total_price -= $(this).data("price");
                    $("#total-price").val(total_price);
                });
            }
            setTotalPrice($("#total-price").val());
        });
        setTotalPrice = (angka) => {
            document.getElementById('total-price-show').innerHTML = 'Rp. ' + angka.toString().replace(
                /(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        }
    </script>
@endsection
