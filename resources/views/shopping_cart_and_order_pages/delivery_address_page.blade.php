<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GRÏP</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/delivery_address_page.css') }}">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg bg-white border-bottom">
        <div class="container-fluid px-4 px-xl-5">
            <a class="navbar-brand logo" href="{{ route('home') }}">GRÏP</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                    aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 text-uppercase fw-semibold gap-lg-5">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('men') }}">Men</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('women') }}">Women</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kids') }}">Kids</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('equipment') }}">Equipment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('sale') }}">Sale</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-4">
                    <form method="GET" action="{{ route('search') }}"
                          class="navbar-search-form d-flex align-items-center">
                        <input
                            type="text"
                            name="q"
                            class="form-control navbar-search-input"
                            placeholder="Search"
                            value="{{ request('q') }}"
                        >
                        <button type="submit" class="nav-icon fs-5 border-0 bg-transparent" aria-label="Search">
                            <i class="ph ph-magnifying-glass"></i>
                        </button>
                    </form>
                    @auth
                        <a href="{{ route('profile') }}" class="nav-icon fs-5" aria-label="User account">
                            <i class="ph ph-user"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="nav-icon fs-5" aria-label="User account">
                            <i class="ph ph-user"></i>
                        </a>
                    @endauth
                    <a href="{{ route('cart') }}" class="nav-icon fs-5" aria-label="Shopping bag">
                        <i class="ph ph-handbag"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>

<main>
    <section class="checkout-page py-5">
        <div class="container-fluid px-4 px-xl-5">
            <div class="row g-5">
                <div class="col-12 col-xl-7">
                    <div class="checkout-form-area">
                        <h1 class="display-title mb-5">Delivery Address</h1>
                        @if(is_null(auth()->id()))
                            <form id="address" method="POST" action="{{ route('checkout.storeAddress') }}" autocomplete="on">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-12 col-md-6">
                                        <label for="firstName" class="visually-hidden">First Name</label>
                                        <input type="text" id="firstName" class="form-control checkout-input" placeholder="First Name">
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label for="lastName" class="visually-hidden">Last Name</label>
                                        <input type="text" id="lastName" class="form-control checkout-input" placeholder="Last Name">
                                    </div>

                                    <div class="col-12">
                                        <label for="country" class="visually-hidden">Country</label>
                                        <select id="country" class="form-select checkout-input">
                                            <option selected>Country</option>
                                            <option>Slovakia</option>
                                            <option>Czech Republic</option>
                                            <option>Austria</option>
                                            <option>Germany</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <label for="postcode" class="visually-hidden">Postcode</label>
                                        <input type="text" id="postcode" class="form-control checkout-input" placeholder="Postcode">
                                    </div>

                                    <div class="col-12 col-md-8">
                                        <label for="city" class="visually-hidden">City</label>
                                        <input type="text" id="city" class="form-control checkout-input" placeholder="City">
                                    </div>

                                    <div class="col-12 col-md-8">
                                        <label for="street" class="visually-hidden">Street</label>
                                        <input type="text" id="street" class="form-control checkout-input" placeholder="Street">
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <label for="streetNo" class="visually-hidden">No.</label>
                                        <input type="text" id="streetNo" class="form-control checkout-input" placeholder="No.">
                                    </div>

                                    <div class="col-12">
                                        <label for="email" class="visually-hidden">Email</label>
                                        <input type="email" id="email" class="form-control checkout-input" placeholder="Email">
                                    </div>

                                    <div class="col-12">
                                        <label for="phone" class="visually-hidden">Phone number</label>
                                        <input type="tel" id="phone" class="form-control checkout-input" placeholder="Phone number">
                                    </div>
                                </div>
                            </form>
                        @else
                            <form id="address" method="POST" action="{{ route('checkout.storeAddress') }}" autocomplete="on">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-12 col-md-6">
                                        <label for="firstName" class="visually-hidden">First Name</label>
                                        <input name="first_name" type="text" id="firstName" class="form-control checkout-input" placeholder="First Name"  value="{{ $cart->user->first_name }}" required>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label for="lastName" class="visually-hidden">Last Name</label>
                                        <input name="last_name" type="text" id="lastName" class="form-control checkout-input" placeholder="Last Name" value="{{ $cart->user->last_name }}" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="country" class="visually-hidden">Country</label>
                                        <select name="country" id="country" class="form-select checkout-input" required>
                                            <option value="">Country</option>
                                            <option value="Slovakia" {{$cart->user->country === 'Slovakia' ? 'selected' : ''}}>Slovakia</option>
                                            <option value="Czech Republic" {{$cart->user->country === 'Czech Republic' ? 'selected' : ''}}>Czech Republic</option>
                                            <option value="Austria" {{$cart->user->country === 'Austria' ? 'selected' : ''}}>Austria</option>
                                            <option value="Germany" {{$cart->user->country === 'Germany' ? 'selected' : ''}}>Germany</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <label for="postcode" class="visually-hidden">Postcode</label>
                                        <input name="postcode" type="text" id="postcode" class="form-control checkout-input" placeholder="Postcode" value="{{ $cart->user->postcode }}" required>
                                    </div>

                                    <div class="col-12 col-md-8">
                                        <label for="city" class="visually-hidden">City</label>
                                        <input name="city" type="text" id="city" class="form-control checkout-input" placeholder="City" value="{{ $cart->user->city }}" required>
                                    </div>

                                    <div class="col-12 col-md-8">
                                        <label for="street" class="visually-hidden">Street</label>
                                        <input name="street" type="text" id="street" class="form-control checkout-input" placeholder="Street" value="{{ $cart->user->street }}" required>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <label for="streetNo" class="visually-hidden">No.</label>
                                        <input name="street_no" type="text" id="streetNo" class="form-control checkout-input" placeholder="No." value="{{ $cart->user->street_no }}" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="email" class="visually-hidden">Email</label>
                                        <input name="email" type="email" id="email" class="form-control checkout-input" placeholder="Email" value="{{ $cart->user->email }}" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="phone" class="visually-hidden">Phone number</label>
                                        <input name="phone" type="tel" id="phone" class="form-control checkout-input" placeholder="Phone number" value="{{ $cart->user->phone_number }}" required>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>

                <div class="col-12 col-xl-5 pt-4">
                    <aside class="summary-box p-4">
                        <h2 class="summary-title mb-5 text-center">Your Order</h2>

                        @foreach($cart->items as $item)
                            <div class="checkout-product mb-4">
                                <div class="row g-3 align-items-start">
                                    <div class="col-3">
                                        <img src="{{ asset($item->product->images->sortBy('sort_order')->first()->image_url ?? 'images/placeholder.jpg') }}"
                                             class="checkout-product-img"
                                             alt="{{ $item->product->images->sortBy('sort_order')->first()->alt_text ?? $product->name }}">
                                    </div>
                                    <div class="col-6">
                                        <h3 class="checkout-product-title mb-1">{{ $item->product->name }}</h3>
                                        <p class="checkout-product-meta mb-0">{{ $item->product->color }} | {{ $item->size }}</p>
                                    </div>
                                    @if($item->product->tags->contains('name','Sale'))
                                        <div class="col-3 text-end">
                                            <p class="checkout-product-price old-price mb-1">{{ number_format($item->fullPrice(),2) }}€</p>
                                            <p class="checkout-product-price mb-0">{{ number_format($item->totalPrice(),2) }}€</p>
                                        </div>
                                    @else
                                        <div class="col-3 text-end">
                                            <p class="checkout-product-price mb-0">{{ number_format($item->totalPrice(),2) }}€</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        <div class="summary-row mb-4">
                            <span>Subtotal plus shipping cost</span>
                            <span>{{ number_format($cart->preDiscount(),2) }}€</span>
                        </div>

                        @php
                            $saleItems = $cart->discountedItems();
                        @endphp
                        <div class="summary-row mb-4">
                                <span>
                                    Discounts<br>
                                    @if($saleItems->isEmpty())
                                        Does not apply<br>
                                    @else
                                        Sale<br>
                                    @endif
                                    @foreach($saleItems as $saleItem)
                                        <span class="summary-note">{{ $saleItem->product->name }}</span><br>
                                    @endforeach
                                </span>
                            <span>{{ number_format($cart->preDiscount() - $cart->postDiscount(),2) }}€</span>
                        </div>
                        <div class="summary-row summary-total mb-5">
                            <span>Total</span>
                            <span>{{ number_format($cart->postDiscount(),2) }}€</span>
                        </div>

                        <div class="text-center">
                            <button type="submit" form="address" class="btn checkout-pill w-50">Continue</button>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
</main>

<footer class="site-footer mt-5 py-4">
    <div class="container-fluid px-4 px-xl-5">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center gap-3">
            <p class="footer-copy mb-0">© 2026 GRÏP ALL RIGHTS RESERVED</p>

            <div class="footer-links d-flex flex-wrap justify-content-center gap-4">
                <a class="footer-link" href="#">Contact</a>
                <a class="footer-link" href="#">Terms of Service</a>
                <a class="footer-link" href="#">Delivery</a>
                <a class="footer-link" href="#">Payment</a>
                <a class="footer-link" href="#">Return Policy</a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.2"></script>
</body>
</html>
