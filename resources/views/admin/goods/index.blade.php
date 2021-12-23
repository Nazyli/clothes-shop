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
                            <li class="breadcrumb-item active"><a href="{{ url('/admin/goods') }}">Master Baju</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data</h3>
                                <div class="card-tools">
                                    <a href="{{ route('goods.create') }}" class="btn btn-primary btn-sm"> Add Data </a>
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
                                <table id="datatable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Category</th>
                                            <th>Base Price</th>
                                            <th>Qty</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($goods as $key => $value)
                                            <tr>
                                                <td>
                                                    {{ $value->id }}
                                                </td>
                                                <td>{{ $value->goods_name }}</td>
                                                <td>{{ $value->descriptionLimit(25) }}</td>
                                                <td class="text-center">
                                                    <span
                                                        class="badge {{ $value->is_active ? 'badge-primary' : 'badge-secondary' }}">{{ $value->status() }}</span>
                                                </td>
                                                <td>{{ $value->category->name }}</td>
                                                <td>@currency($value->base_price)</td>
                                                <td>{{ $value->total_qty }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <form action="{{ route('goods.destroy', $value->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')

                                                            <a href="{{ route('goods.show', $value->id) }}"
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
