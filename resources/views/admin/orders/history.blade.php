@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Purchase History </h1>
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
                            <h3 class="card-title"> List Purchase</h3>
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
                            <table id="datatable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Address</th>
                                        <th>ZIP</th>
                                        <th>Items</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>No Resi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $value)
                                        <tr>
                                            <td class="text-primary">ID#{{ $value->id }} </td>
                                            <td>{{ $value->fullAddressLimit(15) }}</td>
                                            <td>{{ $value->zip_code }}</td>
                                            <td>{{ count($value->orderDetails) }}</td>
                                            <td>{{ $value->total_qty }}</td>
                                            <td class="text-warning">@currency($value->total_price)</td>
                                            <td>{{ $value->no_resi}}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="{{ route('orders.purchase-show', $value->id) }}"
                                                        class="btn btn-outline-info btn-xs"><i
                                                            class="fas fa-info-circle fa-xl"></i></a>
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
            </div>
        </section>
    </div>
@endsection
