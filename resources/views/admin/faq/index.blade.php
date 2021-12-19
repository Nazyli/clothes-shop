@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Frequently Asked Questions </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ url('/admin/faq') }}">Master Faq</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Form Data</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ isset($faq) ? route('faq.update', $faq->id) : route('faq.store') }}"
                                    method="POST">
                                    @csrf
                                    @method(isset($faq) ? 'PUT' : 'POST')

                                    <div class="form-group">
                                        <label for="title"><strong><i class="fas fa-question"></i> Title</strong></label>
                                        <input type="text"
                                            class="form-control form-control-border @error('title') is-invalid @enderror"
                                            id="title" name="title"
                                            value="{{ isset($faq) ? $faq->title : old('title') }}">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <label for="body"><strong><i class="fas fa-reply"></i> Body</strong></label>
                                        <input type="text"
                                            class="form-control form-control-border @error('body') is-invalid @enderror"
                                            id="body" name="body" value="{{ isset($faq) ? $faq->body : old('body') }}">
                                        @error('body')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary btn-block"><b>Save</b></button>
                                    @isset($faq)
                                        <a href="{{ url('admin/faq') }}" class="btn btn-secondary btn-block"><b>Cancel</b></a>
                                    @endisset
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
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
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Body</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($faqs as $key => $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td class="text-primary">{{ $value->title }} </td>
                                                <td>{{ $value->body }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group">

                                                        <form action="{{ route('faq.destroy', $value->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')

                                                            <a href="{{ route('faq.edit', $value->id) }}"
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
                </div>
        </section>
    </div>
@endsection
