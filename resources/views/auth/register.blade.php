@extends('layouts.frontend.app')
@section('title','register')
@section('content')
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
    <!-- Register -->
    <div class="page-account u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="reg-wrapper">
                        <h2 class="account-h2 u-s-m-b-20">Register</h2>
                        <h6 class="account-h6 u-s-m-b-30">Registering for this site allows you to access your order status
                            and history.</h6>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="first_name">Firts Name
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}"
                                    class="text-field form-control @error('first_name') is-invalid @enderror"
                                    placeholder="first name">
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="user-name">Last Name
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}"
                                    class="text-field form-control @error('last_name') is-invalid @enderror"
                                    placeholder="Last Name">
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="user-name">Username
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="user-name" name="username" value="{{ old('username') }}"
                                    class="text-field form-control @error('username') is-invalid @enderror"
                                    placeholder="Username">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email">Email
                                    <span class="astk">*</span>
                                </label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    class="text-field form-control @error('email') is-invalid @enderror"
                                    placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email">Mobile
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="mobile" name="mobile" value="{{ old('mobile') }}"
                                    class="text-field form-control @error('mobile') is-invalid @enderror"
                                    placeholder="Mobile">
                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password">Password
                                    <span class="astk">*</span>
                                </label>
                                <input type="password" id="password" name="password"
                                    class="text-field form-control @error('password') is-invalid @enderror"
                                    placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password2">Confirm Password
                                    <span class="astk">*</span>
                                </label>
                                <input type="password" id="password2" name="password_confirmation" class="text-field"
                                    placeholder="Password">

                            </div>
                            {{-- <div class="u-s-m-b-30">
                        <input type="checkbox" class="check-box" id="accept">
                        <label class="label-text no-color" for="accept">I’ve read and accept the
                            <a href="terms-and-conditions.html" class="u-c-brand">terms & conditions</a>
                        </label>
                    </div> --}}
                            <div class="u-s-m-b-45">
                                <button type="submit" class="button button-primary w-100">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register /- -->
@endsection
