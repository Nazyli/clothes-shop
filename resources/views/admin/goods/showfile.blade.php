@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product Picture</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/admin/goods') }}">Master Baju</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/admin/goods/' . $goods->id) }}">{{ $goods->goods_name }}</a></li>
                            <li class="breadcrumb-item active">Product Picture
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Upload Picture</h3>
                            </div>
                            <div class="card-body">
                                <form enctype="multipart/form-data" action="{{ route('files.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" id="goods_id" name="goods_id" value="{{ $goods->id }}">

                                    <div class="form-group">
                                        <label for="customFile">Account Picture</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('url_path') is-invalid @enderror" id="url_path" name="url_path">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                            @error('url_path')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-block"><b>Save</b></button>
                                    <a href="{{ url('/admin/goods/' . $goods->id) }}"
                                        class="btn btn-secondary btn-block"><b>Cancel</b></a>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data</h3>
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
                            <div class="card-body">
                                <table id="datatable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Url Path</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($files as $key => $value)
                                            <tr>
                                                <td class="text-primary">{{ $value->id }} </td>
                                                <td>
                                                    <img src="{{ $value->pathImg() }}"
                                                        class="img-circle img-size-32 mr-2">
                                                    {{ $value->pathImg() }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <form action="{{ route('files.destroy', $value->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')

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
