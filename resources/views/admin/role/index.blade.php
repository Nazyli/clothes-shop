@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Master Role</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ url('/admin/role') }}">Master Role</a>
                            </li>
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
                                <form action="{{ isset($role) ? route('role.update', $role->id) : route('role.store') }}"
                                    method="POST">
                                    @csrf
                                    @method(isset($role) ? 'PUT' : 'POST')

                                    <div class="form-group">
                                        <label for="name"><strong><i class="fas fa-key"></i> Name</strong></label>
                                        <input type="text"
                                            class="form-control form-control-border @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ isset($role) ? $role->name : old('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <button class="btn btn-primary btn-block"><b>Save</b></button>
                                    @isset($role)
                                        <a href="{{ url('admin/role') }}"
                                            class="btn btn-secondary btn-block"><b>Cancel</b></a>
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
                                            <th>Role ID</th>
                                            <th>Role Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $key => $value)
                                            <tr>
                                                <td class="text-primary">{{ $value->id }} </td>
                                                <td>{{ $value->name }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <form action="{{ route('role.destroy', $value->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')

                                                            <a href="{{ route('role.edit', $value->id) }}"
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
