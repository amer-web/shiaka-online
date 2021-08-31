@extends('layouts.frontend.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<!-- Page Introduction Wrapper -->
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Account</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="home.html">Home</a>
                </li>
                <li class="is-marked">
                    <a href="account.html">Account</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Page Introduction Wrapper /- -->
<!-- Account-Page -->
<div class="page-account u-s-p-t-80">
    <div class="container">
        <div class="row">
            <!-- Login -->
            <div class="col-lg-6">
                <div class="login-wrapper">
                    <h2 class="account-h2 u-s-m-b-20">Login</h2>
                    <h6 class="account-h6 u-s-m-b-30">Welcome back! Sign in to your account.</h6>
                    <form form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="u-s-m-b-30">
                            <label for="user-name-email">Username or Email
                                <span class="astk">*</span>
                            </label>
                            <input type="text" id="user-name-email" name="email" value="{{ old('email') }}" class="text-field" placeholder="Username / Email">
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="login-password">Password
                                <span class="astk">*</span>
                            </label>
                            <input type="password" id="login-password" name="password" class="text-field" placeholder="Password">
                        </div>
                        <div class="group-inline u-s-m-b-30">
                            <div class="group-1">
                                <input type="checkbox" class="check-box" name="remember" id="remember-me-token">
                                <label class="label-text" for="remember-me-token">Remember me</label>
                            </div>
                            <div class="group-2 text-right">
                                <div class="page-anchor">
                                    <a href="lost-password.html">
                                        <i class="fas fa-circle-o-notch u-s-m-r-9"></i>Lost your password?</a>
                                </div>
                            </div>
                        </div>
                        <div class="m-b-45">
                            <button class="button button-outline-secondary w-100" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Login /- -->
            <!-- Register -->
            <div class="col-lg-6">
                <div class="reg-wrapper">
                    <h2 class="account-h2 u-s-m-b-20">Register</h2>
                    <h6 class="account-h6 u-s-m-b-30">Registering for this site allows you to access your order status and history.</h6>
                    <form>
                        <div class="u-s-m-b-30">
                            <label for="user-name">Username
                                <span class="astk">*</span>
                            </label>
                            <input type="text" id="user-name" class="text-field" placeholder="Username">
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="email">Email
                                <span class="astk">*</span>
                            </label>
                            <input type="text" id="email" class="text-field" placeholder="Email">
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="password">Password
                                <span class="astk">*</span>
                            </label>
                            <input type="text" id="password" class="text-field" placeholder="Password">
                        </div>
                        <div class="u-s-m-b-30">
                            <input type="checkbox" class="check-box" id="accept">
                            <label class="label-text no-color" for="accept">I’ve read and accept the
                                <a href="terms-and-conditions.html" class="u-c-brand">terms & conditions</a>
                            </label>
                        </div>
                        <div class="u-s-m-b-45">
                            <button class="button button-primary w-100">Register</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Register /- -->
        </div>
    </div>
</div>



@endsection
