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
    <link rel="stylesheet" href="{{ asset('css/register_and_login_pages.css') }}">
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
