@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Baju</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/admin/goods') }}">Master Baju</a></li>
                            <li class="breadcrumb-item active">{{ $goods->goods_name }} </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Gallery Foto</h3>
                                <div class="card-tools">
                                    <a href="{{ route('goods.create') }}" class="btn btn-info btn-xs"><b> Add Foto </b>
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
                                    @foreach ($goods->masterFileUploads as $key => $value)
                                        <div class="col-6 col-sm">
                                            <a href="{{ $value->pathImg() }}" data-toggle="lightbox"
                                                data-title="{{ $goods->goods_name }} {{ $loop->iteration }}"
                                                data-gallery="gallery">
                                                <img src="{{ $value->pathImg() }}"
                                                    class="img-fluid mb-2 rounded mx-auto d-block" style="max-height :83px"
                                                    alt="{{ $goods->goods_name }} {{ $loop->iteration }}" />
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="callout callout-info">
                            <a href="{{ route('goods.edit', $value->id) }}"
                                class="btn btn-primary btn-xs float-right text-white"><i
                                    class="fas fa-pencil-alt fa-xl"></i></a>

                            <h5 class="text-primary"><i class="fas fa-tshirt"></i> {{ $goods->goods_name }} </h5>
                            <h5 class="text-secondary">Description :</h5>
                            <p>
                                {{ $goods->description }}
                            </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="alert alert-success">
                                        <b>Base Price : </b> @currency($goods->base_price)
                                    </div>
                                    <div class="alert alert-secondary">
                                        <b>Category: </b> {{ $goods->category->name }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="alert alert-info">
                                        <b>Total Quantity : </b> {{ $goods->total_qty }}
                                    </div>
                                    <div class="alert {{ $goods->is_active ? 'alert-primary' : 'alert-Light' }}">
                                        <b>Category: </b> {{ $goods->status() }}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Color - {{ $goods->goods_name }}</h3>
                                <div class="card-tools">
                                    <a href="{{ route('goods.create') }}" class="btn btn-outline-info btn-xs"><b> Add
                                            Color </b></a>

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
                                    @foreach ($goods->goodsColors as $key => $color)
                                        <div class="col-md-4 col-sm-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title"><b>{{ $color->color }}</b>
                                                        &nbsp;&nbsp;&nbsp;
                                                        <span class="badge bg-primary">
                                                            + @currency($color->additional_price)
                                                        </span>
                                                    </h3>

                                                    <div class="card-tools">
                                                        <form action="{{ route('goods.destroy', $value->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')

                                                            <a href="{{ route('goods.edit', $value->id) }}"
                                                                class="btn btn-outline-primary btn-xs"><i
                                                                    class="fas fa-pencil-alt fa-xl"></i></a>
                                                            <button type="submit"
                                                                class="btn btn-outline-danger btn-xs swalSuccesDelete"><i
                                                                    class="fas fa-trash fa-xl"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="card-body p-0">
                                            
                                                    <table class="table table-striped table-sm">
                                                        <thead>
                                                            <tr te>
                                                                <th>Size</th>
                                                                <th class="text-center">Rp.</th>
                                                                <th class="text-center">Qty</th>
                                                                <th class="text-right">Action</th>
                                                            </tr>
                                                        <tbody>
                                                            @foreach ($color->goodsSizes as $key => $size)
                                                                <tr>
                                                                    <td class="text-left">{{ $size->size }}</td>
                                                                    <td class="text-center">
                                                                        <span class="badge bg-primary float-right">+
                                                                            @currency($size->additional_price)</span>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{ $size->qty }}
                                                                    </td>
                                                                    <td class="text-right">
                                                                        <div class="btn-group">
                                                                            <form
                                                                                action="{{ route('goods.destroy', $value->id) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                @method('DELETE')

                                                                                <a href="{{ route('goods.edit', $value->id) }}"
                                                                                    class="btn btn-outline-primary btn-xs"><i
                                                                                        class="fas fa-pencil-alt fa-xl"></i></a>


                                                                                <button type="submit"
                                                                                    class="btn btn-outline-danger btn-xs swalSuccesDelete"><i
                                                                                        class="fas fa-trash fa-xl"></i></button>
                                                                            </form>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
