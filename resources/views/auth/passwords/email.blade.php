@extends('layouts.auth')

@section('css')

@endsection

@section('content')
<!-- Header -->
<div class="header bg-gradient-primary py-7 py-lg-8 ">
    <div class="container">
    <div class="header-body text-center mb-4">
        <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
            <h1 class="text-white">Aw snap!</h1>
        </div>
        </div>
    </div>
    </div>
    <div class="separator separator-bottom separator-skew zindex-100">
    <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
        <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
    </svg>
    </div>
</div>
<!-- Page content -->
<div class="container mt--8 pb-5">
    <div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
        <div class="card card-profile bg-secondary mt-5">
        <div class="card-body px-5">
            <div class="text-center text-muted mb-4">
            <small>Reset password with email</small>
            </div>
            <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                </div>
                <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-2">{{ __('Send Password Reset Link') }}</button>
            </div>
            </form>
        </div>
        </div>
        <div class="row mt-3">
        <div class="col-6">
            @guest
                @if(Route::has('register'))
                <a class="text-light" href="{{ route('register') }}"><small>{{ __('Register') }}</small></a>
                @endif
            @endguest
        </div>
        <div class="col-6 text-right">
            @guest
                <a class="text-light" href="{{ route('login') }}"><small>{{ __('Login') }}</small></a>
            @endguest
        </div>
        </div>
    </div>
    </div>
</div>
@endsection

@section('javascript-optional')

@endsection

@section('javascript')

@endsection
