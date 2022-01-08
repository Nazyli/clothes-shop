@extends('auth.app')

@section('content')
    <div class="p-4">
        <div class="text-right">
            <a href="{{ url('/') }}">
                <img src="{{ asset('img/logo.png') }}" class="rounded">
            </a>
        </div>
        <div class="text-muted">Don&apos;t have an account? <a class="text-danger"
                href="{{ url('/register') }}">Sign Up </a></div>
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
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <input id="email" type="email" placeholder="Email"
                class="form-control mb-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input id="password" type="password" placeholder="Password"
                class="form-control  mb-3 @error('password') is-invalid @enderror" name="password"
                autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="d-flex justify-content-between py-4">
                <div class="text-muted">
                    <label>
                        <label for="remember">

                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            {{ __('Remember Me') }}
                        </label>

                </div>
                <div>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-danger btn-lg w-100">
                {{ __('Sign In') }}
            </button>
        </form>

    </div>
@endsection
