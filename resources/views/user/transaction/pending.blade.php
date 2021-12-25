@extends('user.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Pending Transaction </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Pending Transaction </a></li>
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
                                {{ count($orders) }} items pending transaction</h3>
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
                                        <th>Created at</th>
                                        <th>Total Items</th>
                                        <th>Total Qty</th>
                                        <th>Total Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $value)
                                        <tr>
                                            <td class="text-primary">ID#{{ $value->id }} </td>
                                            <td>{{ $value->created_at }}</td>
                                            <td>{{ count($value->orderDetails) }}</td>
                                            <td>{{ $value->total_qty }}</td>
                                            <td class="text-warning">@currency($value->total_price)</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <form action="{{ route('transaction.destroy', $value->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('transaction.confirm', $value->id) }}"
                                                            class="btn btn-outline-info btn-xs"><i
                                                                class="fas fa-info-circle fa-xl"></i></a>


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
            </div>
        </section>
    </div>
@endsection
