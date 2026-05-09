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
    <link rel="stylesheet" href="{{ asset('css/admin_interface.css') }}">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg bg-white border-bottom">
        <div class="container-fluid px-4 px-xl-5 justify-content-between">
            <a class="navbar-brand logo" href="{{ route('admin.inventory') }}">GRÏP</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="nav-icon fs-5" style="background:none;border:0;">
                    <i class="ph ph-user"></i>
                </button>
            </form>
        </div>
    </nav>
</header>

<div class="d-flex px-4 justify-content-between pt-4 align-items-center border-bottom product-bar">
    <div class="d-flex flex-column px-4">
        <p class="products-title mb-0">Products</p>
        <p class="mt-0">{{ $products->count() }}</p>
    </div>
    <form method="GET" action="{{ route('admin.inventory') }}" class="navbar-search-form d-flex align-items-center">
        <input type="text" name="search" class="form-control navbar-search-input" placeholder="Search" value="{{ request('search') }}">
        <button type="submit" class="nav-icon fs-5 border-0 bg-transparent" aria-label="Search">
            <i class="ph ph-magnifying-glass"></i>
        </button>
    </form>
</div>
<div class="px-4 border-bottom py-4">
    <div id="grid">
        <span></span>
        <span class="column-title">Name</span>
        <span class="column-title">Price</span>
        <span class="column-title">Discount</span>
        <span></span>

        @foreach($products as $product)
            <img src="{{ asset($product->images->sortBy('sort_order')->first()->image_url ?? 'images/placeholder.jpg') }}" class="img-preview" alt="{{ $product->images->sortBy('sort_order')->first()->alt_text ?? $product->name }}">
            <span>{{ $product->name }}</span>
            <span>{{ $product->price }}</span>
            @if($product->tags->contains('name','Sale'))
                <span>{{ $product->discount_percent }}%</span>
            @else
                <span></span>
            @endif
            <div class="d-flex gap-3">
                <a href="{{ route('admin.edit', $product->id) }}" class="nav-icon"><i class="ph ph-pencil-line "></i></a>
                <form method="POST" action="{{ route('admin.delete', $product->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="nav-icon border-0 bg-transparent"><i class="ph ph-trash"></i></button>
                </form>
            </div>
        @endforeach
    </div>
</div>
<div class="d-flex py-4 justify-content-center">
    <a href="{{ route('admin.new')}}" class="nav-icon" style="font-size: 36px;"><i class="ph ph-plus-circle"></i></a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.2"></script>
</body>
</html>
