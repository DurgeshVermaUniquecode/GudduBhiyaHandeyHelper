@extends('layouts.app-auth')

@section('content')
<form action="{{ route('login') }}" method="post">
    @csrf
    <div class="input-group mb-3">
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-envelope"></span>
        </div>
        </div>
        @error('email')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="input-group mb-3">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-lock"></span>
        </div>
        </div>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="row">
        <div class="col-8">
        <div class="icheck-primary">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember">
            Remember Me
            </label>
        </div>
        </div>
        <!-- /.col -->
        <div class="col-4">
        <button type="submit" class="btn btn-dark btn-block">Sign In</button>
        </div>
        <!-- /.col -->
    </div>
</form>
<div class="social-auth-links text-center mt-2 mb-3">
    <a href="{{ route('home') }}" class="btn btn-block btn-danger">
        <i class="fas fa-home mr-2"></i> Back To Home
    </a>
    <a href="{{ route('register') }}" class="btn btn-block btn-dark">
        <i class="fas fa-user-plus mr-2"></i> Register a account
    </a>
</div>
<!-- /.social-auth-links -->
@if (Route::has('password.request'))
<p class="mb-1">
    <a class="text-dark" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
</p>
@endif

@endsection
