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
                    <form method="GET" action="{{ route('search') }}" class="navbar-search-form d-flex align-items-center">
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
    <section class="category-hero category-hero-sale d-flex align-items-center">
        <div class="container text-center">
            <h1 class="display-title text-white mb-3">SALE</h1>
            <p class="category-hero-subtitle mb-0">
                Outlet finds built for real climbing days
            </p>
        </div>
    </section>

    <section class="catalog-controls py-5">
        <div class="container-fluid px-4 px-xl-5">
            <div class="category-shortcuts d-flex flex-wrap gap-3 mb-4">
                <a href="{{ route('sale') }}" class="catalog-pill">All</a>
                <a href="{{ route('sale', ['category' => 'Shoes']) }}" class="catalog-pill">Shoes</a>
                <a href="{{ route('sale', ['category' => 'Clothing']) }}" class="catalog-pill">Clothing</a>
                <a href="{{ route('sale', ['category' => 'Equipment']) }}" class="catalog-pill">Equipment</a>
            </div>

            <hr class="catalog-divider my-4">

            <form method="GET" action="{{ route('sale') }}">
                @if(request()->filled('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif

                @if(request()->filled('sale'))
                    <input type="hidden" name="sale" value="{{ request('sale') }}">
                @endif

                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center gap-3">
                    <div class="filter-buttons d-flex flex-wrap gap-3">
                        <div class="dropdown">
                            <button class="catalog-pill dropdown-toggle btn" type="button" id="price" data-bs-toggle="dropdown">
                                Price
                            </button>
                            <ul class="dropdown-menu px-3 py-2" aria-labelledby="price">
                                <li class="d-flex flex-column gap-2">
                                    <label>
                                        <input type="number" name="min_price" class="form-control" placeholder="Min" value="{{ request('min_price') }}" onchange="this.form.submit()">                                    </label>
                                    <label>
                                        <input type="number" name="max_price" class="form-control" placeholder="Max" value="{{ request('max_price') }}" onchange="this.form.submit()">                                    </label>
                                </li>
                            </ul>
                        </div>

                        <div class="dropdown">
                            <button class="catalog-pill dropdown-toggle btn" type="button" id="color" data-bs-toggle="dropdown">
                                Color
                            </button>
                            <ul class="dropdown-menu px-3" aria-labelledby="color">
                                @foreach($colorTags as $colorTag)
                                    <li>
                                        <label>
                                            <input
                                                type="checkbox"
                                                name="color[]"
                                                value="{{ $colorTag->name }}"
                                                {{ in_array($colorTag->name, request()->input('color', [])) ? 'checked' : '' }}
                                                onchange="this.form.submit()"
                                            >
                                            {{ $colorTag->name }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="dropdown">
                            <button class="catalog-pill dropdown-toggle btn" type="button" id="size" data-bs-toggle="dropdown">
                                Size
                            </button>
                            <ul class="dropdown-menu px-3" aria-labelledby="size">
                                @if(request('category') === 'Shoes')
                                    @foreach($shoeSizeTags as $sizeTag)
                                        <li>
                                            <label>
                                                <input
                                                    type="checkbox"
                                                    name="size[]"
                                                    value="{{ $sizeTag->name }}"
                                                    {{ in_array($sizeTag->name, request()->input('size', [])) ? 'checked' : '' }}
                                                    onchange="this.form.submit()"
                                                >
                                                {{ $sizeTag->name }}
                                            </label>
                                        </li>
                                    @endforeach
                                @elseif(request('category') === 'Clothing' || request('category') === 'Equipment')
                                    @foreach($clothingSizeTags as $sizeTag)
                                        <li>
                                            <label>
                                                <input
                                                    type="checkbox"
                                                    name="size[]"
                                                    value="{{ $sizeTag->name }}"
                                                    {{ in_array($sizeTag->name, request()->input('size', [])) ? 'checked' : '' }}
                                                    onchange="this.form.submit()"
                                                >
                                                {{ $sizeTag->name }}
                                            </label>
                                        </li>
                                    @endforeach
                                @else
                                    @foreach($clothingSizeTags as $sizeTag)
                                        <li>
                                            <label>
                                                <input
                                                    type="checkbox"
                                                    name="size[]"
                                                    value="{{ $sizeTag->name }}"
                                                    {{ in_array($sizeTag->name, request()->input('size', [])) ? 'checked' : '' }}
                                                    onchange="this.form.submit()"
                                                >
                                                {{ $sizeTag->name }}
                                            </label>
                                        </li>
                                    @endforeach

                                    @foreach($shoeSizeTags as $sizeTag)
                                        <li>
                                            <label>
                                                <input
                                                    type="checkbox"
                                                    name="size[]"
                                                    value="{{ $sizeTag->name }}"
                                                    {{ in_array($sizeTag->name, request()->input('size', [])) ? 'checked' : '' }}
                                                    onchange="this.form.submit()"
                                                >
                                                {{ $sizeTag->name }}
                                            </label>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                        <div class="dropdown">
                            <button class="catalog-pill dropdown-toggle btn" type="button" id="brand" data-bs-toggle="dropdown">
                                Brand
                            </button>
                            <ul class="dropdown-menu px-3" aria-labelledby="brand">
                                @foreach($brands as $brand)
                                    <li>
                                        <label>
                                            <input
                                                type="checkbox"
                                                name="brand[]"
                                                value="{{ $brand->name }}"
                                                {{ in_array($brand->name, request()->input('brand', [])) ? 'checked' : '' }}
                                                onchange="this.form.submit()"
                                            >
                                            {{ $brand->name }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <a
                            href="{{ route('sale', array_filter([
                                'category' => request('category'),
                                'sale' => 1,
                            ])) }}"
                            class="catalog-pill btn"
                            style="background-color: #e0e0e0; color: black;"
                        >
                            Clear Filters
                        </a>
                    </div>


                    <div class="d-flex flex-wrap">
                        <span>SORT BY:</span>
                        <label>
                            <select name="sort" style="border: none; background: transparent" onchange="this.form.submit()">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>NEWEST</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>PRICE: LOW TO HIGH</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>PRICE: HIGH TO LOW</option>
                            </select>
                        </label>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="pt-5">
        <div class="container-fluid px-4 px-xl-5">
            <div class="row gx-5 gy-4">
                @foreach($products as $product)
                    <div class="col-12 col-sm-6 col-lg-3">
                        <a href="{{ route('detail', $product->id) }}" class="product-card-link">
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
            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>
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
