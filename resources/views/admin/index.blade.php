@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="text-navy">Welcome Back - <span class="text-danger"> Administrator</span></h1>
                        <h6 class="mt-2 text-primary"> <i class="fas fa-user mr-2"></i>  {{ Auth::user()->getFullName() }} 
                        </h6>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Admin</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-primary disabled">
                            <span class="info-box-icon"><i class="fas fas fa-tshirt"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Product</span>
                                <span class="info-box-number">
                                    {{ App\Models\Goods::count() }} Data
                                </span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                    <a href="{{ url('admin/goods') }}" class="text-light">
                                        More info <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-teal">
                            <span class="info-box-icon"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Members</span>
                                <span class="info-box-number">
                                    {{ App\Models\User::count() }} Data
                                </span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <a href="{{ url('admin/user') }}" class="text-light">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-indigo">
                            <span class="info-box-icon"><i class="fas fas fa-receipt"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Purchase</span>
                                <span class="info-box-number">
                                    {{                                     App\Models\Orders::whereNotNull('no_resi')->count() }}
                                    Data
                                </span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <a href="{{ route('orders.purchase') }}" class="text-light">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-maroon">
                            <span class="info-box-icon"><i class="far fa-images"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Product Picture</span>
                                <span class="info-box-number">
                                    {{ App\Models\MasterFileUpload::count() }} Data
                                </span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <a href="#" class="text-light">
                                    Clothes Photo 
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-navy">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Latest Orders</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive" style="max-height: 500px;
                                    overflow-y: auto;">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Status</th>
                                                <th>Qty</th>
                                                <th>Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (App\Models\Orders::orderBy('created_at', 'DESC')->limit(11)->get()
        as $value)
                                                <tr>
                                                    <td class="text-primary font-weight-bold">ID#{{ $value->id }}</td>
                                                    @php
                                                        $colorBadge = '';
                                                        $status = '';
                                                        if (!isset($value->payments_id)) {
                                                            $colorBadge = 'badge-info';
                                                            $status = 'Waiting payment';
                                                        } elseif (!isset($value->no_resi)) {
                                                            $colorBadge = 'badge-warning';
                                                            $status = 'Need Confirm';
                                                        } elseif ($value->no_resi) {
                                                            $colorBadge = 'badge-success';
                                                            $status = 'Shipped';
                                                        }
                                                    @endphp
                                                    <td><span class="badge {{ $colorBadge }}">{{ $status }}</span>
                                                    </td>
                                                    <td>{{ $value->total_qty }}</td>
                                                    <td class="text-warning font-weight-bold text-right">
                                                        @currency($value->total_price)</td>
                                                </tr>
                                            @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer clearfix">
                                <a href="{{ route('orders.confirm') }}" class="btn btn-sm btn-warning float-left">Need
                                    Confirm</a>
                                <a href="{{ route('orders.purchase') }}"
                                    class="btn btn-sm btn-success float-right">Shipped
                                    Orders</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-danger">
                            <div class="  card-header p-3">
                                <h3 class="card-title">Lowest Stock</h3>
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
                            <div class="card-body p-0">
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                    @foreach (App\Models\GoodsSize::orderBy('qty', 'asc')->limit(3)->get()
        as $value)
                                        <li class="item">
                                            <div class="product-img">
                                                <img src="{{ $value->goodsColor->goods->masterFileUpload()->pathImg() }}"
                                                    alt="{{ $value->goodsColor->goods->goods_name }}"
                                                    class="img-size-32">
                                            </div>
                                            <div class="product-info">
                                                <a href="{{ route('goods.show', $value->goodsColor->goods->id) }}"
                                                    class="product-title">{{ $value->goodsColor->goods->goods_name }}
                                                    <span class="badge badge-danger float-right">Qty :
                                                        {{ $value->qty }}</span></a>
                                                <span class="product-description">
                                                    {{ $value->goodsColor->color }}, {{ $value->size }}
                                                </span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Recently Added Products</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                    @foreach (App\Models\Goods::orderBy('created_at', 'DESC')->limit(3)->get()
        as $value)
                                        <li class="item">
                                            <div class="product-img">
                                                <img src="{{ $value->masterFileUpload()->pathImg() }}"
                                                    alt="{{ $value->goods_name }}" class="img-size-32">
                                            </div>
                                            <div class="product-info">
                                                <a href="{{ route('goods.show', $value->id) }}"
                                                    class="product-title">{{ $value->goods_name }}
                                                    <span
                                                        class="badge badge-success float-right">@currency($value->base_price)</span></a>
                                                <span class="product-description">
                                                    {{ $value->descriptionLimit(20) }}
                                                </span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-footer text-center">
                                <a href="{{ url('admin/goods') }}" class="uppercase">View All Products</a>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
