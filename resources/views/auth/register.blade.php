@extends('auth.app')

@section('content')
    <div class="p-4">
        <div class="text-right">
            <a href="{{ url('/') }}">
                <img src="{{ asset('img/logo.png') }}" class="rounded">
            </a>
        </div>
        <div class="text-muted">Already have an account? <a class="text-danger" href="{{ url('/login') }}">Sign In </a>
        </div>
        {{--  <hr />
        <div class="row">
            <div class="col-6">
                <a class="btn btn-block btn-sm btn-social btn-twitter text-white">
                    <span class="fa fa-facebook"></span> Sign in with Facebook
                </a>
            </div>
            <div class="col-6">
                <a class="btn btn-block btn-sm btn-social btn-google text-white">
                    <span class="fa fa-google"></span> Sign in with Google
                </a>
            </div>
        </div>  --}}
        <h6 class="separator my-4">or</h6>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <input id="first_name" placeholder="First Name" type="text"
                        class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                        value="{{ old('first_name') }}" autocomplete="first_name" autofocus>

                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <input id="last_name" placeholder="Last Name" type="text"
                        class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                        value="{{ old('last_name') }}" autocomplete="last_name" autofocus>

                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <input id="email" placeholder="Email" type="email" class="form-control mb-3 @error('email') is-invalid @enderror"
                name="email" value="{{ old('email') }}" autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input id="phone" placeholder="Phone Number" type="text"
                class="form-control mb-3 @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"
                autocomplete="phone" autofocus>

            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input id="password" placeholder="Password" type="password"
                class="form-control mb-3 @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input id="password-confirm" placeholder="Retype Password" type="password" class="form-control mb-3"
                name="password_confirmation" required autocomplete="new-password">
            <button type="submit" class="btn btn-danger btn-lg w-100">
                {{ __('Sign Up') }}
            </button>
        </form>

    </div>
@endsection
