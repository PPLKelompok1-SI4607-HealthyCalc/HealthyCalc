@extends('layouts.app')

@section('content')
    <div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center">
        <div class="row p-4 w-100 h-100 d-flex align-items-center">
            <div class="col-12 col-lg-6 order-1 order-lg-2">
                <div class="text-center">
                    <img src="/img/healthycalc.png" class="img-fluid" alt="Sign Up Illustration">
                </div>
            </div>
            <div class="col-12 col-lg-6 order-2 order-lg-1">
                <p class="text-center fs-4 fw-bold text-success">Sign In</p>
                <p class="text-center fs-6">Welcome back!</p>
                <p class="text-center fs-6">Don't have an account?
                    <span> <a href="{{ url('/register') }} " class="text-success">Sign Up</a></span>
                </p>
                <form method="POST" action="{{ route('login') }}" class="w-100">
                    @csrf
                    <div class="mb-3">
                        <input type="email" name="email" dusk="email" class="form-control"
                            placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" dusk="password" class="form-control"
                            placeholder="Enter your password">
                    </div>
                    <button type="submit" dusk="login-button" class="btn btn-primary w-100">Sign In</button>
                </form>
            </div>
        </div>
    </div>
@endsection
