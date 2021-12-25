@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Need Confirmation Transaction </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Need Confirm </a></li>
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
                            <h3 class="card-title"> You have
                                {{ count($orders) }} items need confirmation transaction</h3>
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
                            <table id="datatable" class="table table-sm table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer</th>
                                        <th>Purchase Date</th>
                                        <th>Address</th>
                                        <th>ZIP</th>
                                        <th>Items</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $value)
                                        <tr>
                                            <td class="text-primary">ID#{{ $value->id }} </td>
                                            <td>
                                                <img src="{{ $value->user->pathImg() }}"
                                                    class="img-circle img-size-32 mr-2">
                                                {{ $value->user->getFullName() }}
                                            </td>
                                            <td>{{ $value->updated_at }}</td>
                                            <td>{{ $value->fullAddressLimit(15) }}</td>
                                            <td>{{ $value->zip_code }}</td>
                                            <td>{{ count($value->orderDetails) }}</td>
                                            <td>{{ $value->total_qty }}</td>
                                            <td class="text-warning">@currency($value->total_price)</td>
                                            <td class="text-center">
                                                <a href="{{ route('orders.confirm-show', $value->id) }}"
                                                    class="btn btn-outline-info btn-xs">
                                                    <i class="fas fa-info-circle fa-xl"></i></a>
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
