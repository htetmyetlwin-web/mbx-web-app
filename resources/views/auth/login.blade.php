@extends('layouts.app')

@section('content')

<div class="login-box">
    <div class="login-logo">
        <img src="{{asset('images/mergui-logo.png')}}" width="80%">
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">{{ __('Login') }}</p>
            <form method="POST" action="{{ route('login') }}">
            @csrf

                <div class="input-group mb-3">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" required  autofocus>

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
                <div class="input-group mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">

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
                        <input  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <!-- <input type="checkbox" id="remember"> -->
                            <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                        </div>
                    </div>

                    <div class="col-4">
                        <button type="submit" class="btn btn-warning btn-block">  {{ __('Login') }}</button>
                    </div>

                </div>
            </form>
            <!-- <div class="social-auth-links text-center mb-3">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                </a>
                <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                </a>
            </div> -->

            <!-- <p class="mb-1">
            @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    @endif            </p> -->
            <p class="mb-0">
                <a class="btn btn-link" href="{{route('register')}}" class="text-center">Create new account</a>
            </p>
        </div>

    </div>
</div>

@endsection