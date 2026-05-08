@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user_profile.css') }}">
@endpush

@section('content')
    <section>
        <div class="container-fluid px-4 px-xl-5">
            <div class="row py-5">
                <div class="col-sm-3 d-none d-sm-flex align-items-center nav-col">
                    <div class="d-flex flex-column gap-5">
                        <a href="{{ route('profile') }}" class="side-nav"><i class="side-nav-icon ph ph-user"></i>Account</a>
                        <a href="#" class="side-nav-cosmetic"><i class="side-nav-icon ph ph-clipboard"></i>Orders</a>
                        <a href="#" class="side-nav-cosmetic"><i class="side-nav-icon ph ph-credit-card"></i>Payment Methods</a>
                        <a href="#" class="side-nav-cosmetic"><i class="side-nav-icon ph ph-gear-six"></i>Settings</a>
                    </div>
                </div>
                <div class="d-flex d-sm-none justify-content-between">
                    <a href="{{ route('profile') }}" class="side-nav"><i class="side-nav-icon ph ph-user"></i></a>
                    <a href="#" class="side-nav-cosmetic"><i class="side-nav-icon ph ph-clipboard"></i></a>
                    <a href="#" class="side-nav-cosmetic"><i class="side-nav-icon ph ph-credit-card"></i></a>
                    <a href="#" class="side-nav"><i class="side-nav-icon ph ph-gear-six"></i></a>
                </div>
                <hr class="d-sm-none catalog-divider my-4">
                <div class="col-12 col-sm-7">
                    <div class="d-sm-flex d-flex flex-wrap justify-content-between align-items-center">
                        <h2 class="profile-title">ACCOUNT</h2>
                        <div class="d-flex justify-content-center">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="logout-button">Log out</button>
                            </form>
                        </div>
                    </div>
                    <hr class="catalog-divider my-4">
                    <div class="text-end">
                        <p class="profile-text-bold px-3">Name</p>
                        <input type="text" class="info-box text-end" value="{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}" readonly>
                        <p class="profile-text-bold px-3">Email</p>
                        <input type="email" class="info-box text-end" value="{{ auth()->user()->email }}" readonly>
                        <p class="profile-text-bold px-3">Phone Number</p>
                        <input type="tel" class="info-box text-end" value="{{ auth()->user()->phone_number }}" readonly>
                        <p class="profile-text-bold px-3">Shipping Address</p>
                        <input type="text" class="info-box text-end" value="{{ auth()->user()->street }} {{ auth()->user()->street_no }}, {{ auth()->user()->city }}, {{ auth()->user()->country }}, {{ auth()->user()->postcode }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

