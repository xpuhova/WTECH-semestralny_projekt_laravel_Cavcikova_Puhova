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
    <link rel="stylesheet" href="{{ asset('css/payment_and_delivery_page.css') }}">
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
    <section class="payment-page py-5">
        <div id="total-data" data-pre-discount="{{ $cart->preDiscount() }}" data-post-discount="{{ $cart->postDiscount() }}"></div>
        <div class="container-fluid px-4 px-xl-5">
            <form id="payment" method="POST" action="{{ route('checkout.makeOrder') }}">
                @csrf
                <div class="row g-5">
                    <div class="col-12 col-xl-7">
                        <div class="checkout-options-section mb-5">
                            <h1 class="display-title mb-5">Payment and Delivery</h1>

                            <h2 class="summary-title mb-4">Delivery options</h2>

                            <div class="checkout-option-list">
                                @foreach($deliveryOptions as $deliveryOption)
                                    <label class="checkout-option">
                                        <input type="radio" name="delivery" class="form-check-input checkout-radio" data-price="{{ $deliveryOption->price }}" onchange="updateShippingCost()" value="{{ $deliveryOption->id }}" required>
                                        <span class="checkout-option-content">
                                            <span class="checkout-option-text-wrap">
                                                <span class="checkout-option-title">{{ $deliveryOption->name }}</span>
                                                <span class="checkout-option-text">{{ $deliveryOption->description }}</span>
                                            </span>
                                            <span class="checkout-option-price">{{ $deliveryOption->price == 0 ? 'Free' : $deliveryOption->price }}</span>
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="checkout-options-section">
                            <h2 class="summary-title mb-4">Payment options</h2>

                            <div class="checkout-option-list">
                                    @foreach($paymentOptions as $paymentOption)
                                    <div class="payment-option">
                                        <input type="radio" name="payment" id="payment_{{ $paymentOption->id }}" class="form-check-input checkout-radio" value="{{ $paymentOption->id }}" required>
                                        <label for="payment_{{ $paymentOption->id }}" class="checkout-option">
                                            <span class="checkout-option-content">
                                                <span class="checkout-option-text-wrap">
                                                    <span class="checkout-option-title">{{ $paymentOption->name}}</span>
                                                    <span class="checkout-option-text">{{ $paymentOption->description}}</span>
                                                </span>
                                            </span>
                                        </label>

                                        @if($paymentOption->name == "Credit / Debit Card")
                                            <div class="payment-extra-fields">
                                                <div class="row g-3 mt-2">
                                                    <div class="col-lg-6 col-md-6 col-12">
                                                        <label for="cardNumber" class="visually-hidden">Card Number</label>
                                                        <input type="text" name="card_number" id="cardNumber" class="form-control" placeholder="Card Number">
                                                    </div>
                                                    <div class="col-lg-6 col-md-6"></div>
                                                    <div class="col-lg-3 col-md-3 col-6">
                                                        <label for="expirationDate" class="visually-hidden">Expiration Date</label>
                                                        <input type="text" name="expiration_date" id="expirationDate" class="form-control" placeholder="Expiration Date">
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-6">
                                                        <label for="cvc" class="visually-hidden">CVC</label>
                                                        <input type="text" name="cvc" id="cvc" class="form-control" placeholder="CVC">
                                                    </div>
                                                    <div class="col-lg-6 col-md-3"></div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-xl-5 pt-4">
                        <aside class="summary-box p-4">
                            <h2 class="summary-title mb-5 text-center">Overview</h2>

                            <div class="summary-row mb-4">
                                <span>Subtotal plus shipping cost</span>
                                <span id="subtotal">{{ number_format($cart->preDiscount(),2) }}€</span>
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

                            <div class="summary-row summary-total mb-4">
                                <span>Total</span>
                                <span id="total">{{ number_format($cart->postDiscount(),2) }}€</span>
                            </div>

                            <div class="text-center">
                                <button type="submit" form="payment" class="btn checkout-pill w-50">Make order</button>
                            </div>
                        </aside>
                    </div>
                </div>
            </form>
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

<script src="{{ asset('js/checkout_scripts.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.2"></script>
</body>
</html>
