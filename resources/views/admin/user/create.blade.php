@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Membership</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ url('/admin/user') }}">Master User</a>
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
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Form Data</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ isset($user) ? route('user.update', $user->id) : route('user.store') }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method(isset($user) ? 'PUT' : 'POST')

                                    <div class="form-group">
                                        <label for="first_name"><strong>First Name</strong></label>
                                        <input type="text"
                                            class="form-control form-control-border @error('first_name') is-invalid @enderror"
                                            id="first_name" name="first_name"
                                            value="{{ isset($user) ? $user->first_name : old('first_name') }}">
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="last_name"><strong>Last Name</strong></label>
                                        <input type="text"
                                            class="form-control form-control-border @error('last_name') is-invalid @enderror"
                                            id="last_name" name="last_name"
                                            value="{{ isset($user) ? $user->last_name : old('last_name') }}">
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="phone"><strong>Phone</strong></label>
                                        <input type="text"
                                            class="form-control form-control-border @error('phone') is-invalid @enderror"
                                            id="phone" name="phone"
                                            value="{{ isset($user) ? $user->phone : old('phone') }}">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email"><strong>Email</strong></label>
                                        <input type="text"
                                            class="form-control form-control-border @error('email') is-invalid @enderror"
                                            id="email" name="email"
                                            value="{{ isset($user) ? $user->email : old('email') }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    @if (!isset($user))
                                        <div class="form-group">
                                            <label for="password"><strong>Password</strong></label>
                                            <input type="password"
                                                class="form-control form-control-border @error('password') is-invalid @enderror"
                                                id="password" name="password" value="{{ old('password') }}">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="exampleInputBorder"><strong>Role</strong></label>
                                        <select
                                            class="custom-select form-control-border @error('role_id') is-invalid @enderror"
                                            name="role_id">
                                            @if (!isset($user)) <option disabled selected value></option> @endif
                                            @foreach ($roles as $key => $value)
                                                <option value="{{ $value->id }}"
                                                    {{ isset($user) ? ($user->role_id == $value->id ? 'selected' : '') : old('role_id') }}>
                                                    {{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="customFile">Account Picture</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="foto" name="foto">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary btn-block"><b>Save</b></button>
                                    <a href="{{ url('admin/user') }}"
                                        class="btn btn-secondary btn-block"><b>Cancel</b></a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
