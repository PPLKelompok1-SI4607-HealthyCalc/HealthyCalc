@extends('layouts.app')

@section('content')
<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-100 p-4">
        <!-- Gambar -->
        <div class="col-12 col-lg-6 order-1 order-lg-2 d-flex justify-content-center align-items-center">
            <div class="text-center">
                <img src="/img/healthycalc.png" class="img-fluid" alt="Sign Up Illustration">
            </div>
        </div>

        <!-- Form -->
        <div class="col-12 col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <p class="text-center fs-4 fw-bold text-success">Sign Up</p>
            <p class="text-center fs-6">Already have an account?
                <span><a href="{{ url('/login') }}" class="text-success">Sign In</a></span>
            </p>
            <form method="POST" action="{{ url('/register') }}" class="w-100 px-4">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" name="name" placeholder="Enter your name"
                        value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Enter your username"
                        value="{{ old('username') }}">
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Enter your email"
                        value="{{ old('email') }}">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Enter your password">
                </div>
                <button class="btn btn-primary w-100 bg-green" type="submit">Create account</button>
            </form>
        </div>
    </div>
</div>
@endsection
