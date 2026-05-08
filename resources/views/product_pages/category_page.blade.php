@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/category_pages.css') }}">
@endpush

@section('content')
    <section class="category-hero {{ $page['heroClass'] }} d-flex align-items-center">
        <div class="container text-center">
            <h1 class="display-title text-white mb-3">{{ $page['title'] }}</h1>
            <p class="category-hero-subtitle mb-0">
                {{ $page['subtitle'] }}
            </p>
        </div>
    </section>

    <section class="catalog-controls py-5">
        <div class="container-fluid px-4 px-xl-5">
            <div class="category-shortcuts d-flex flex-wrap gap-3 mb-4">
                <a href="{{ route('category_page', array_merge(['page' => $page['slug']], request()->except('page', 'category', 'sale'))) }}" class="catalog-pill">
                    All
                </a>

                @foreach($page['shortcuts'] as $shortcut)
                    @if($shortcut === 'Sale')
                        <a href="{{ route('category_page', array_merge(['page' => $page['slug']], request()->except('page', 'category'), ['sale' => 1])) }}" class="catalog-pill">
                            Sale
                        </a>
                    @else
                        <a href="{{ route('category_page', array_merge(['page' => $page['slug']], request()->except('page', 'sale'), ['category' => $shortcut])) }}" class="catalog-pill">
                            {{ $shortcut }}
                        </a>
                    @endif
                @endforeach
            </div>

            <hr class="catalog-divider my-4">

            <form method="GET" action="{{ route('category_page', $page['slug']) }}">
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
                            href="{{ route('category_page', array_merge(['page' => $page['slug']], array_filter([
                            'category' => request('category'),
                            'sale' => request('sale'),
                            ]))) }}"
                            class="catalog-pill btn"
                            style="background-color: #e0e0e0; color: black;"
                        >
                            Clear Filters
                        </a>                    </div>


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
                    @include('partials.product_card', ['product' => $product])
                @endforeach
            </div>
        </div>
    </section>

    <section class="pagination-section py-5">
        <div class="container-fluid px-4 px-xl-5">
            <div class="d-flex flex-column align-items-center gap-3">
                {{ $products->links('pagination::bootstrap-4') }}

                <p class="mb-0 text-muted">
                    Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} results
                </p>
            </div>
        </div>
    </section>

    @include('partials.trust_strip')
@endsection
