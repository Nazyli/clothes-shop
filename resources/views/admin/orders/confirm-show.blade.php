@extends('admin.layouts.app')

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
                    <div class="card card-orange card-outline col-12">
                        <div class="card-header">
                            <h3 class="card-title">Detail Orders <label class="text-primary">
                                    ID#{{ $order->id }}
                                </label></h3>
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
                            <div class="product-details-cart mr-2">
                                <h6 class="mb-0">Purchased items</h6>
                                <div class="d-flex justify-content-between"><span>You have
                                        {{ count($order->orderDetails) }} items in your cart</span>
                                </div>
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
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-user"></i>
                                    &nbsp;&nbsp;Customer
                                </h3>
                            </div>
                            <div class="card-body">
                                <dl class="row">
                                    <dt class="col-sm-4">Name</dt>
                                    <dd class="col-sm-8">{{ $order->user->getFullName() }}</dd>
                                    <dt class="col-sm-4">Address</dt>
                                    <dd class="col-sm-8">{{ $order->full_address }}</dd>
                                    <dt class="col-sm-4">ZIP Code</dt>
                                    <dd class="col-sm-8">{{ $order->zip_code }}</dd>
                                    <dt class="col-sm-4">Latitude</dt>
                                    <dd class="col-sm-8">{{ $order->lat }}</dd>
                                    <dt class="col-sm-4">Longitude</dt>
                                    <dd class="col-sm-8">{{ $order->long }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-info"></i>
                                    &nbsp;&nbsp;Details
                                </h3>
                            </div>
                            <div class="card-body">
                                <dl class="row">
                                    <dt class="col-sm-4">Phone</dt>
                                    <dd class="col-sm-8">{{ $order->phone }}</dd>
                                    <dt class="col-sm-4">Email</dt>
                                    <dd class="col-sm-8">{{ $order->email }}</dd>
                                    <dt class="col-sm-4">Payment Method</dt>
                                    <dd class="col-sm-8">{{ $order->paymentMethod()->name }}</dd>
                                </dl>
                                <div class="text-center row">
                                    <div class="col-6 col-sm">
                                        <a href="{{ $order->pathImg() }}" data-toggle="lightbox"
                                            data-title="Evidence Transfer" data-gallery="gallery">
                                            <img src="{{ $order->pathImg() }}"
                                                class="img-fluid mb-2 rounded mx-auto d-block" style="max-height :80px"
                                                alt="Evidence Transfer" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card col-12" style="border-bottom: 3px solid #fd7e14;">
                        <div class="card-body">
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
                                    <a class="btn btn-success btn-lg" data-toggle="modal"
                                        data-target='#confirmOrderModal'><b>
                                            Confirm Order &nbsp;&nbsp;&nbsp; <i class="fas fa-check">
                                            </i></b></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>


    {{-- Modal Edit Product --}}

    <div class="modal fade" tabindex="-1" role="dialog" id="confirmOrderModal">
        <div class="modal-dialog" role="document">
            <form id="set_resi" action="{{ route('orders.confirm-approve', $order->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id" value="{{ $order->id }}">
                        <div class="form-group">
                            <label for="no_resi"><strong>No Resi</strong></label>
                            <input type="text" class="form-control form-control-sm rounded-0" id="no_resi" name="no_resi">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                        <button type="button" onclick="form_submit()" class="btn btn-success btn-sm">
                            <b>Confirm <i class="fas fa-check"></i></b></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')

    <script type="text/javascript">
        function form_submit() {
            document.getElementById("set_resi").submit();
        }
    </script>
@endsection
