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
                        <img src="{{ asset('images/register.jpg') }}" alt="Climbing lifestyle visual" class="register-img">
                        <div class="register-visual-overlay text-black">
                            <h2 class="register-visual-title mb-3">JOIN US</h2>
                            <p class="register-visual-text mb-0">Become a part of something greater</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="register-form-area">
                        <h1 class="display-title mb-2">Register</h1>
                        <p class="register-subtitle mb-4">
                            Already have an account?
                            <a href="{{ route('login') }}" class="register-link">Log in.</a>
                        </p>

                        <form method="POST" action="{{ route('register.store') }}">
                            @csrf
                            <div class="row g-4">
                                <div class="col-12 col-md-6">
                                    <label for="firstName" class="visually-hidden">First Name</label>
                                    <input type="text" name="first_name" id="firstName" class="form-control register-input" placeholder="First Name" value="{{ old('first_name') }}">
                                    @error('first_name')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="lastName" class="visually-hidden">Last Name</label>
                                    <input type="text" name="last_name" id="lastName" class="form-control register-input" placeholder="Last Name" value="{{ old('last_name') }}">
                                    @error('last_name')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="email" class="visually-hidden">Email</label>
                                    <input type="email" name="email" id="email" class="form-control register-input" placeholder="Email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="password" class="visually-hidden">Password</label>
                                    <input type="password" name="password" id="password" class="form-control register-input" placeholder="Password">
                                    @error('password')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="confirmPassword" class="visually-hidden">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="confirmPassword" class="form-control register-input" placeholder="Confirm Password">
                                </div>

                                <div class="col-12">
                                    <label for="country" class="visually-hidden">Country</label>
                                    <select name="country" id="country" class="form-select register-input">
                                        <option value="" {{ old('country') == '' ? 'selected' : '' }}>Country</option>
                                        <option value="Slovakia" {{ old('country') == 'Slovakia' ? 'selected' : '' }}>Slovakia</option>
                                        <option value="Czech Republic" {{ old('country') == 'Czech Republic' ? 'selected' : '' }}>Czech Republic</option>
                                        <option value="Austria" {{ old('country') == 'Austria' ? 'selected' : '' }}>Austria</option>
                                        <option value="Germany" {{ old('country') == 'Germany' ? 'selected' : '' }}>Germany</option>
                                    </select>
                                    @error('country')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-4">
                                    <label for="postcode" class="visually-hidden">Postcode</label>
                                    <input type="text" name="postcode" id="postcode" class="form-control register-input" placeholder="Postcode" value="{{ old('postcode') }}">
                                    @error('postcode')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-8">
                                    <label for="city" class="visually-hidden">City</label>
                                    <input type="text" name="city" id="city" class="form-control register-input" placeholder="City" value="{{ old('city') }}">
                                    @error('city')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-8">
                                    <label for="street" class="visually-hidden">City</label>
                                    <input type="text" name="street" id="street" class="form-control register-input" placeholder="Street" value="{{ old('street') }}">
                                    @error('street')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-4">
                                    <label for="streetNo" class="visually-hidden">Postcode</label>
                                    <input type="text" name="street_no" id="streetNo" class="form-control register-input" placeholder="No." value="{{ old('street_no') }}">
                                    @error('street_no')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="phoneNumber" class="visually-hidden">Address</label>
                                    <input type="tel" name="phone_number" id="phoneNumber" class="form-control register-input" placeholder="Phone Number" value="{{ old('phone_number') }}">
                                    @error('phone_number')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 pt-2">
                                    <div class="text-center text-lg-start">
                                        <button type="submit" class="btn checkout-pill">Create account</button>
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
