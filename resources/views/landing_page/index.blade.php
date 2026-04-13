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
    <link rel="stylesheet" href="{{ asset('css/landing_page.css') }}">
</head>

<body>
<header>
    <nav class="navbar navbar-expand-xl bg-white border-bottom">
        <div class="container-fluid px-4 px-xl-5">
            <a class="navbar-brand logo" href="{{ route('home') }}">GRÏP</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                    aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 text-uppercase fw-semibold gap-xl-5">
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
                    <a href="../product_pages/product_detail_page.blade.php" class="product-card-link">
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
                    <a href="../product_pages/product_detail_page.blade.php" class="product-card-link">
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
                    <a href="../product_pages/product_detail_page.blade.php" class="product-card-link">
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
                    <a href="../product_pages/product_detail_page.blade.php" class="product-card-link">
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
                            <a href="{{ route('sale') }}" class="btn btn-light pill-button mt-3">
                                Discover More <span class="ms-2">→</span>
                            </a>
                        </div>
                    </article>
                </div>
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
