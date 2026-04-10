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
    <link rel="stylesheet" href="{{ asset('css/category_pages.css') }}">
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
                        <a class="nav-link" href="../product_pages/mens_page.html">Men</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../product_pages/womens_page.html">Women</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../product_pages/kids_page.html">Kids</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../product_pages/equipment_page.html">Equipment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../product_pages/sale_page.html">Sale</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-4">
                    <a href="#" class="nav-icon fs-5" aria-label="Search">
                        <i class="ph ph-magnifying-glass"></i>
                    </a>
                    @auth
                        <a href="{{ route('profile') }}" class="nav-icon fs-5" aria-label="User account">
                            <i class="ph ph-user"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="nav-icon fs-5" aria-label="User account">
                            <i class="ph ph-user"></i>
                        </a>
                    @endauth
                    <a href="../shopping_cart_and_order_pages/shopping_cart.html" class="nav-icon fs-5" aria-label="Shopping bag">
                        <i class="ph ph-handbag"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>

<main>
    <section class="category-hero category-hero-women d-flex align-items-center">
        <div class="container text-center">
            <h1 class="display-title text-white mb-3">WOMEN</h1>
            <p class="category-hero-subtitle mb-0">
                Climbing shoes and accessories designed for comfort, control, and power.
            </p>
        </div>
    </section>

    <section class="catalog-controls py-5">
        <div class="container-fluid px-4 px-xl-5">
            <div class="category-shortcuts d-flex flex-wrap gap-3 mb-4">
                <a href="#" class="catalog-pill">Shoes</a>
                <a href="#" class="catalog-pill">Clothing</a>
                <a href="#" class="catalog-pill">Equipment</a>
                <a href="#" class="catalog-pill">Sale</a>
            </div>

            <hr class="catalog-divider my-4">

            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center gap-3">
                <div class="filter-buttons d-flex flex-wrap gap-3">
                    <div class="dropdown">
                        <button class="catalog-pill dropdown-toggle btn" type="button" id="price" data-bs-toggle="dropdown">
                            Price
                        </button>
                        <ul class="dropdown-menu px-3 py-2" aria-labelledby="price">
                            <li class="d-flex flex-column gap-2">
                                <label><input type="number" class="form-control" placeholder="Min"></label>
                                <label><input type="number" class="form-control" placeholder="Max"></label>
                            </li>
                        </ul>
                    </div>

                    <div class="dropdown">
                        <button class="catalog-pill dropdown-toggle btn" type="button" id="color" data-bs-toggle="dropdown">
                            Color
                        </button>
                        <ul class="dropdown-menu px-3" aria-labelledby="color">
                            <li><label><input type="checkbox" value="black">Black</label></li>
                            <li><label><input type="checkbox" value="white">White</label></li>
                            <li><label><input type="checkbox" value="gray">Gray</label></li>
                            <li><label><input type="checkbox" value="navy">Navy</label></li>
                            <li><label><input type="checkbox" value="blue">Blue</label></li>
                            <li><label><input type="checkbox" value="red">Red</label></li>
                            <li><label><input type="checkbox" value="black">Green</label></li>
                            <li><label><input type="checkbox" value="white">Yellow</label></li>
                            <li><label><input type="checkbox" value="gray">Orange</label></li>
                            <li><label><input type="checkbox" value="navy">Pink</label></li>
                            <li><label><input type="checkbox" value="blue">Purple</label></li>
                            <li><label><input type="checkbox" value="red">Brown</label></li>
                            <li><label><input type="checkbox" value="red">Beige</label></li>
                        </ul>
                    </div>

                    <div class="dropdown">
                        <button class="catalog-pill dropdown-toggle btn" type="button" id="size" data-bs-toggle="dropdown">
                            Size
                        </button>
                        <ul class="dropdown-menu px-3" aria-labelledby="size">
                            <li><label><input type="checkbox" name="clothingSize" value="xs">XS</label></li>
                            <li><label><input type="checkbox" name="clothingSize" value="s">S</label></li>
                            <li><label><input type="checkbox" name="clothingSize" value="m">M</label></li>
                            <li><label><input type="checkbox" name="clothingSize" value="xl">XL</label></li>
                            <li><label><input type="checkbox" name="clothingSize" value="xxl">XXL</label></li>
                            <li><label><input type="checkbox" name="shoeSize" value="355">35.5</label></li>
                            <li><label><input type="checkbox" name="shoeSize" value="36">36</label></li>
                            <li><label><input type="checkbox" name="shoeSize" value="37">37</label></li>
                            <li><label><input type="checkbox" name="shoeSize" value="375">37.5</label></li>
                            <li><label><input type="checkbox" name="shoeSize" value="38">38</label></li>
                            <li><label><input type="checkbox" name="shoeSize" value="39">39</label></li>
                            <li><label><input type="checkbox" name="shoeSize" value="395">39.5</label></li>
                            <li><label><input type="checkbox" name="shoeSize" value="40">40</label></li>
                            <li><label><input type="checkbox" name="shoeSize" value="41">41</label></li>
                            <li><label><input type="checkbox" name="shoeSize" value="415">41.5</label></li>
                            <li><label><input type="checkbox" name="shoeSize" value="42">42</label></li>
                            <li><label><input type="checkbox" name="shoeSize" value="425">42.5</label></li>
                            <li><label><input type="checkbox" name="shoeSize" value="43">43</label></li>
                        </ul>
                    </div>

                    <div class="dropdown">
                        <button class="catalog-pill dropdown-toggle btn" type="button" id="brand" data-bs-toggle="dropdown">
                            Brand
                        </button>
                        <ul class="dropdown-menu px-3" aria-labelledby="size">
                            <li><label><input type="checkbox" name="brand" value="butora"> Butora</label></li>
                            <li><label><input type="checkbox" name="brand" value="crux"> Crux</label></li>
                            <li><label><input type="checkbox" name="brand" value="evolv"> Evolv</label></li>
                            <li><label><input type="checkbox" name="brand" value="e9"> E9</label></li>
                            <li><label><input type="checkbox" name="brand" value="contour"> Contour</label></li>
                        </ul>
                    </div>
                </div>

                <div class="d-flex flex-wrap">
                    <span>SORT BY:</span>
                    <label>
                        <select style="border: none; background: transparent">
                            <option>RELEVANCE</option>
                            <option>PRICE: LOW TO HIGH</option>
                            <option>PRICE: HIGH TO LOW</option>
                            <option>NEWEST</option>
                            <option>POPULARITY</option>
                        </select>
                    </label>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-5">
        <div class="container-fluid px-4 px-xl-5">
            <div class="row gx-5 gy-4">
                @foreach($products as $product)
                    <div class="col-12 col-sm-6 col-lg-3">
                        <a href="#" class="product-card-link">
                            <article class="card h-100 border-0 bg-transparent">
                                <img
                                    src="{{ asset($product->images->sortBy('sort_order')->first()->image_url ?? 'images/placeholder.jpg') }}"
                                    class="card-img"
                                    alt="{{ $product->images->sortBy('sort_order')->first()->alt_text ?? $product->name }}"
                                >
                                <div class="card-body text-center">
                                    <h3 class="h6 mb-2">{{ $product->name }}</h3>
                                    <p class="mb-1 text-muted">{{ $product->brief_description }}</p>
                                    @if($product->discount_percent > 0)
                                        @php
                                            $discountedPrice = $product->price * (1 - $product->discount_percent / 100);
                                        @endphp

                                        <p class="fw-semibold old-price mb-1">{{ number_format($product->price, 2) }}€</p>
                                        <p class="fw-semibold mb-0">{{ number_format($discountedPrice, 2) }}€</p>
                                    @else
                                        <p class="fw-semibold mb-0">{{ number_format($product->price, 2) }}€</p>
                                    @endif
                                </div>
                            </article>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="pagination-section py-5">
        <div class="container-fluid px-4 px-xl-5">
            <ul class="pagination justify-content-center mb-0">
                <li class="page-item disabled">
                    <a class="page-link" href="#">Previous</a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </div>
    </section>

    <section class="trust-strip py-4">
        <div class="container-fluid px-4 px-xl-5">
            <div class="row gy-3 text-center">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="trust-item">
                        <i class="ph ph-arrow-u-up-left trust-icon" aria-hidden="true"></i>
                        <span class="trust-label">EASY RETURNS</span>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="trust-item">
                        <i class="ph ph-shield trust-icon" aria-hidden="true"></i>
                        <span class="trust-label">SECURE PAYMENT</span>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="trust-item">
                        <i class="ph ph-package trust-icon" aria-hidden="true"></i>
                        <span class="trust-label">FREE DELIVERY OVER 100€</span>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="trust-item">
                        <i class="ph ph-chat-circle-text trust-icon" aria-hidden="true"></i>
                        <span class="trust-label">EXPERT GEAR ADVICE</span>
                    </div>
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
