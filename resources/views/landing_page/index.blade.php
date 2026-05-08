@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/landing_page.css') }}">
@endpush

@section('content')
    <section class="hero d-flex align-items-center">
        <div class="container text-center">
            <h1 class="display-title text-white mb-3">Become Limitless</h1>
            <p class="hero-subtitle mb-0">
                Performance footwear and essentials for every climb.
            </p>
        </div>
    </section>

    <section class="new-in-section pb-5">
        <div class="container-fluid px-4 px-xl-5">
            <div class="text-start mb-5">
                <h2 class="display-title mb-0">New In</h2>
            </div>
            <div class="row gx-5 gy-4">
                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="{{ route('detail', 1) }}" class="product-card-link">
                        <article class="card h-100 border-0 bg-transparent">
                            <img src="{{ asset('images/lasportiva_miura_vs.jpg') }}" class="card-img-new-in" alt="La Sportiva Miura VS climbing shoes">
                            <div class="card-body text-center">
                                <h3 class="h6 mb-2">La Sportiva Miura VS</h3>
                                <p class="mb-1 text-muted">Aggressive, high-performance sport and multipitch climbing shoe</p>
                                <p class="fw-semibold mb-0">145.00€</p>
                            </div>
                        </article>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="{{ route('detail', 4) }}" class="product-card-link">
                        <article class="card h-100 border-0 bg-transparent">
                            <img src="{{ asset('images/stan_chalk_bag.jpg') }}" class="card-img-new-in" alt="8b+ 8BPLUS Chalk Bag &quot;Stan&quot;">
                            <div class="card-body text-center">
                                <h3 class="h6 mb-2">8b+ 8BPLUS Chalk Bag &quot;Stan&quot;</h3>
                                <p class="mb-1 text-muted">A chalk bag with an adjustable strap and a carabiner</p>
                                <p class="fw-semibold mb-0">32.00€</p>
                            </div>
                        </article>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="{{ route('detail', 2) }}" class="product-card-link">
                        <article class="card h-100 border-0 bg-transparent">
                            <img src="{{ asset('images/E9_enove_bia-vs_women_pants.jpg') }}" class="card-img-new-in" alt="E9 Enove Bia-Vs women's pants">
                            <div class="card-body text-center">
                                <h3 class="h6 mb-2">E9 Enove Bia-Vs women's pants</h3>
                                <p class="mb-1 text-muted">Climbing and outdoor pants made of organic cotton corduroy</p>
                                <p class="fw-semibold mb-0">110.00€</p>
                            </div>
                        </article>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="{{ route('detail', 3) }}" class="product-card-link">
                        <article class="card h-100 border-0 bg-transparent">
                            <img src="{{ asset('images/BD_black_diamond_vision_harness.jpg') }}" class="card-img-new-in" alt="BD Black Diamond Vision Airnet Recco harness">
                            <div class="card-body text-center">
                                <h3 class="h6 mb-2">BD Black Diamond Vision Airnet Recco harness</h3>
                                <p class="mb-1 text-muted">An ultralight and complete climbing harness</p>
                                <p class="fw-semibold mb-0">170.00€</p>
                            </div>
                        </article>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="promo-section py-5">
        <div class="container-fluid px-4 px-xl-5">
            <div class="row g-4">
                <div class="col-12 col-lg-6">
                    <article class="promo-card promo-popular d-flex align-items-end">
                        <div class="promo-content text-white">
                            <h2 class="display-title text-white mb-2">Popular</h2>
                            <a href="#" class="btn btn-light pill-button mt-3">
                                Discover More <span class="ms-2">→</span>
                            </a>
                        </div>
                    </article>
                </div>

                <div class="col-12 col-lg-6">
                    <article class="promo-card promo-sale d-flex align-items-end">
                        <div class="promo-content text-white">
                            <h2 class="display-title text-white mb-2">Sale</h2>
                            <a href="{{ route('category_page', 'sale') }}" class="btn btn-light pill-button mt-3">                                Discover More <span class="ms-2">→</span>
                            </a>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>

    @include('partials.trust_strip')
@endsection

