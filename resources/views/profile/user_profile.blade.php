<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GRÏP</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@400;500;600;700&family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user_profile.css') }}">
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
