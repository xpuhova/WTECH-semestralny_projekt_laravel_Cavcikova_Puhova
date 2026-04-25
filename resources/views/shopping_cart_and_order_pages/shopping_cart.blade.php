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
    <link rel="stylesheet" href="{{ asset('css/shopping_cart.css') }}">
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
    @if(!$cart || $cart->items->isEmpty())
        <p>Cart Empty</p>
    @else
        <section class="cart-page py-5">
            <div class="container-fluid px-4 px-xl-5">
                <div class="text-center mb-5">
                    <h1 class="display-title">Shopping Cart</h1>
                </div>

                <div class="row g-5">
                    <div class="col-12 col-xl-8">
                        <div class="row mt-5 mb-3 d-none d-lg-flex">
                            <div class="col-md-7"></div>
                            <div class="col-md-3 text-center">
                                <h2 class="cart-section-label mb-0">Quantity</h2>
                            </div>
                            <div class="col-md-1 text-center">
                                <h2 class="cart-section-label mb-0">Total</h2>
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        @foreach($cart->items as $item)
                            <article class="cart-item py-4">
                                <div class="row gy-4">
                                    <div class="col-12">
                                        <div class="row align-items-start">
                                            <div class="col-5 col-md-3">
                                                <img src="{{ asset($item->product->images->sortBy('sort_order')->first()->image_url ?? 'images/placeholder.jpg') }}"
                                                     class="cart-item-img"
                                                     alt="{{ $item->product->images->sortBy('sort_order')->first()->alt_text ?? $product->name }}">
                                            </div>

                                            <div class="col-7 col-md-4">
                                                <h2 class="cart-item-title mb-3">{{ $item->product->name }}</h2>
                                                <p class="mb-2"><strong>Color</strong> <span class="ms-2 text-muted">{{ $item->product->color }}</span></p>
                                                <p class="mb-0"><strong>Size</strong> <span class="ms-2 text-muted">{{ $item->size }}</span></p>
                                            </div>

                                            <div class="d-none d-md-block col-md-3 text-center">
                                                <form method="POST" action="{{ route('cart.update') }}">
                                                    @csrf
                                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                                    <div class="quantity-control">
                                                        <button type="submit" name="change" value="-1" class="quantity-btn-small">-</button>
                                                        <span class="quantity-value">{{ $item->quantity }}</span>
                                                        <button type="submit" name="change" value="1" class="quantity-btn-small">+</button>
                                                    </div>
                                                </form>
                                            </div>

                                            @if($item->product->tags->contains('name','Sale'))
                                                <div class="d-none d-md-block col-md-1 text-center">
                                                    <p class="cart-price old-price mb-1">{{ number_format($item->fullPrice(),2) }}€</p>
                                                    <p class="cart-price mb-0">{{ number_format($item->totalPrice(),2) }}€</p>
                                                </div>
                                            @else
                                            <div class="d-none d-md-block col-md-1 text-center">
                                                <p class="cart-price mb-0">{{ number_format($item->totalPrice(),2) }}€</p>
                                            </div>
                                            @endif
                                            <div class="d-none d-md-block col-md-1 text-end">
                                                <form method="POST" action="{{ route('cart.delete') }}">
                                                    @csrf
                                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                                    <button type="submit" class="remove-btn" aria-label="Remove item">
                                                        <i class="ph ph-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 d-md-none">
                                        <div class="row align-items-center text-center">
                                            <div class="col-5">
                                                <div class="fw-semibold mb-2">Quantity</div>
                                                <form method="POST" action="{{ route('cart.update') }}">
                                                    @csrf
                                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                                    <div class="quantity-control">
                                                        <button type="submit" name="change" value="-1" class="quantity-btn-small">-</button>
                                                        <span class="quantity-value">{{ $item->quantity }}</span>
                                                        <button type="submit" name="change" value="1" class="quantity-btn-small">+</button>
                                                    </div>
                                                </form>
                                            </div>

                                            @if($item->product->tags->contains('name','Sale'))
                                            <div class="col-4">
                                                <div class="fw-semibold mb-2">Total</div>
                                                <p class="cart-price old-price mb-1">{{ number_format($item->fullPrice(),2) }}€</p>
                                                <p class="cart-price mb-0">{{ number_format($item->totalPrice(),2) }}€</p>
                                            </div>
                                            @else
                                            <div class="col-4">
                                                <div class="fw-semibold mb-2">Total</div>
                                                <p class="cart-price mb-0">{{ number_format($item->totalPrice(),2) }}€</p>
                                            </div>
                                            @endif

                                            <div class="col-3 text-end">
                                                <form method="POST" action="{{ route('cart.delete') }}">
                                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                                    @csrf
                                                    <button type="submit" class="remove-btn" aria-label="Remove item">
                                                        <i class="ph ph-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="col-12 col-xl-4 pt-5">
                        <aside class="summary-box p-4">
                            <h2 class="summary-title mb-5 text-center">Overview</h2>

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

                            <div class="summary-row summary-total mb-4">
                                <span>Total</span>
                                <span>{{ number_format($cart->postDiscount(),2) }}€</span>
                            </div>

                            <a href="{{ route('checkout.address') }}" class="btn checkout-pill w-100 mt-3">Proceed to checkout</a>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
    @endif
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
