@extends('layouts.app-auth')

@section('content')
<form action="{{ route('register') }}" method="post">
    @csrf
    <div class="input-group mb-3">                                
        <input id="name" type="text" placeholder="Enter name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user"></span>
            </div>
        </div>
        @error('name')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="input-group mb-3">
        <input id="email" type="email" placeholder="Enter email address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
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
        <input id="password" type="password" placeholder="Enter password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
        @error('password')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="input-group mb-3">
        <input id="password-confirm" type="password" placeholder="Enter password confirm" class="form-control" name="password_confirmation" required autocomplete="new-password">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <div class="icheck-dark">
                <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                <label for="agreeTerms">I agree to the <a href="#" class="text-gray">terms</a></label>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-4">
            <button type="submit" class="btn btn-dark">Register</button>
        </div>
        <!-- /.col -->
    </div>
</form>

<div class="social-auth-links text-center mt-2 mb-3">
    <a href="{{ route('home') }}" class="btn btn-block btn-danger">
        <i class="fas fa-home mr-2"></i> Back To Home
    </a>
    <a href="{{ route('login') }}" class="btn btn-block btn-dark">
        <i class="fas fa-user-plus mr-2"></i> Back to login
    </a>
</div>
@endsection
