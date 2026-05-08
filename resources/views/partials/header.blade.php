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
                        <a class="nav-link" href="{{ route('category_page', 'men') }}">Men</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category_page', 'women') }}">Women</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category_page', 'kids') }}">Kids</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category_page', 'equipment') }}">Equipment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category_page', 'sale') }}">Sale</a>
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
