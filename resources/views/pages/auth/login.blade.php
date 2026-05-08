@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/register_and_login_pages.css') }}">
@endpush

@section('content')
    <section class="register-page py-5">
        <div class="container-fluid px-4 px-xl-5">
            <div class="row g-4 align-items-start">
                <div class="col-12 col-lg-6">
                    <div class="register-visual">
                        <img src="{{ asset('images/login.jpeg') }}" alt="Climbing lifestyle visual" class="login-img">
                        <div class="login-visual-overlay text-white">
                            <h2 class="register-visual-title mb-3">WELCOME BACK</h2>
                            <p class="register-visual-text mb-0">Grow with confidence</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="register-form-area">
                        <h1 class="display-title mb-2">Log in</h1>
                        <p class="register-subtitle mb-4">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="register-link">Register.</a>
                        </p>

                        <form method="POST" action="/login">
                            @csrf
                            <div class="row g-4">
                                <div class="col-12">
                                    <label for="email" class="visually-hidden">First Name</label>
                                    <input type="email" name="email" id="email" class="form-control register-input" placeholder="Email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="password" class="visually-hidden">Last Name</label>
                                    <input type="password" name="password" id="password" class="form-control register-input" placeholder="Password" required>
                                    @error('password')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 pt-2">
                                    <div class="text-center text-lg-start">
                                        <button type="submit" class="btn checkout-pill">Log in</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.trust_strip')
@endsection
