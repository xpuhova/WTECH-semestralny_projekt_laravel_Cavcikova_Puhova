@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/product_detail_page.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shopping_cart.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@400;500;600;700&family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
@endpush

@section('content')
    <section>
        <div class="container-fluid px-4 px-xl-5">
            <div class="row py-5">
                <div class="col-12 col-sm-6">
                    <nav class="d-block d-sm-none">
                        <ol class="breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="#">{{ $product->name }}</a></li>
                        </ol>
                    </nav>
                    <div class="d-sm-flex d-none flex-column">
                        <img src="{{ asset($product->images->sortBy('sort_order')->first()->image_url ?? 'images/placeholder.jpg') }}"
                             class="main-product-img"
                             alt="{{ $product->images->sortBy('sort_order')->first()->alt_text ?? $product->name }}">
                        <div class="row gx-1 gy-4">
                            @foreach($product->images->sortBy('sort_order')->skip(1) as $image)
                                <div class="col-6">
                                    <img src="{{ asset($image->image_url ?? 'images/placeholder.jpg') }}"
                                         class="alternative-product-img"
                                         alt="{{ $image->alt_text ?? $product->name }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="d-sm-none d-flex justify-content-center">
                        <div id="productPictures" class="carousel carousel-dark slide px-5" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($product->images->sortBy('sort_order')->values() as $index => $image)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset($image->image_url ?? 'images/placeholder.jpg') }}"
                                             class="alternative-product-img"
                                             alt="{{ $image->alt_text ?? $product->name }}">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-next" type="button" data-bs-target="#productPictures" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                            <button class="carousel-control-prev" type="button" data-bs-target="#productPictures" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 ps-4">
                    <nav class="d-none d-sm-block">
                        <ol class="breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="#">{{ $product->name }}</a></li>
                        </ol>
                    </nav>
                    @if($product->tags->contains('name','Sale'))
                        <span class="badge bg-danger px-3 py-2 border border-dark mt-3 mb-2 shadow-sm">-{{ $product->discount_percent }}%</span>
                    @endif
                    <div>
                        <h2 class="display-title mb-3">{{ $product->name }}</h2>
                        <p class="product-description">{{ $product->brief_description }}</p>
                        <div class="d-flex flex-wrap gap-2">
                            @if($product->tags->contains('name','Sale'))
                                <p class="description-text">{{ number_format($product->finalPrice(), 2) }}€</p>
                                <p class="old-product-price">{{ number_format($product->price, 2) }}€</p>
                            @else
                                <p class="description-text">{{ number_format($product->finalPrice(), 2) }}€</p>
                            @endif
                        </div>
                        <div class="rating mb-2">
                            <i class="ph ph-star ph-fill"></i>
                            <i class="ph ph-star ph-fill"></i>
                            <i class="ph ph-star ph-fill"></i>
                            <i class="ph ph-star ph-fill"></i>
                            <i class="ph ph-star ph-fill"></i>
                            <span class="rating-text">5.0 (1)</span>
                        </div>
                        <p class="description-text">COLOR: {{ Str::upper($product->color) }}</p>
                        <hr class="catalog-divider my-4">
                        <form method="POST" action="{{ route('cart.add') }}">
                            @csrf
                            @php
                                $sizeOrder = [
                                    'XXS' => 1,
                                    'XS' => 2,
                                    'S' => 3,
                                    'M' => 4,
                                    'L' => 5,
                                    'XL' => 6,
                                    '6 Years' => 7,
                                    '8 Years' => 8,
                                    '10 Years' => 9,
                                    '12 Years' => 10,
                                ];

                                $sizeTags = $product->tags
                                    ->whereIn('type', [
                                        'adult_shoe_size',
                                        'kids_shoe_size',
                                        'adult_clothing_size',
                                        'kids_clothing_size',
                                    ])
                                    ->sortBy(function ($tag) use ($sizeOrder) {
                                        return $tag->type === 'adult_shoe_size'
                                            ? (float) $tag->name
                                            : ($sizeOrder[$tag->name] ?? 999);
                                    });
                            @endphp

                            @if($sizeTags->isNotEmpty())
                                <p class="description-text">SIZE</p>

                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($sizeTags as $tag)
                                        <label class="size-button">
                                            <input type="radio" class="btn-check" name="size" value="{{ $tag->name }}" required>
                                            <span>{{ $tag->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            @endif
                            <div class="d-flex  mt-3">
                                <button type="button" onclick="changeQuantity(-1)" class="quantity-btn-small">-</button>
                                    <input class="quantity-field" type="number" id="quantity" name="quantity" value="1" min="1">
                                <button type="button" onclick="changeQuantity(1)" class="quantity-btn-small">+</button>
                            </div>
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="selection-button mt-3">
                                <i class="ph ph-tote-simple ph-fill"></i>ADD TO BASKET
                            </button>
                        </form>
                        <p class="info-text mt-3"><i class="ph ph-package"></i>Standard delivery within 4-5 business days</p>
                        <p class="info-text"><i class="ph ph-gift ph-fill"></i>Free shipping for all orders above 100€</p>
                    </div>
                </div>
            </div>
            <p class="description-text">{{ $product->detailed_description }}</p>
            <hr class="catalog-divider my-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="display-title">Features & Specifications</h2>
                <a class="collapse-button" data-bs-toggle="collapse" href="#featuresCollapse" aria-expanded="true"><i class="ph ph-arrow-up collapse-icon"></i></a>
            </div>
            <div class="collapse show" id="featuresCollapse">
                <ul class="description-text mt-3">
                    @foreach($product->features as $feature)
                        <li>{{ $feature }}</li>
                    @endforeach
                </ul>
            </div>
            <hr class="catalog-divider my-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="display-title">Reviews</h2>
                <a class="collapse-button" data-bs-toggle="collapse" href="#ratingCollapse" aria-expanded="true"><i class="ph ph-arrow-up collapse-icon"></i></a>
            </div>
            <div class="collapse show" id="ratingCollapse">
                <div class="d-sm-flex d-none gap-5 mt-3">
                    <div class="bars">
                        <div class="d-flex align-items-center gap-3">
                            <span class="rating-number">5 stars</span>
                            <div class="rating-background">
                                <div class="rating-percentage" style="width: 100%"></div>
                            </div>
                            <span class="rating-number">1</span>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="rating-number">4 stars</span>
                            <div class="rating-background">
                                <div class="rating-percentage" style="width: 0%"></div>
                            </div>
                            <span class="rating-number">0</span>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="rating-number">3 stars</span>
                            <div class="rating-background">
                                <div class="rating-percentage" style="width: 0%"></div>
                            </div>
                            <span class="rating-number">0</span>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="rating-number">2 stars</span>
                            <div class="rating-background">
                                <div class="rating-percentage" style="width: 0%"></div>
                            </div>
                            <span class="rating-number">0</span>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="rating-number">1 stars</span>
                            <div class="rating-background">
                                <div class="rating-percentage" style="width: 0%"></div>
                            </div>
                            <span class="rating-number">0</span>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <h3 class="overall-title">Overall Rating</h3>
                        <div class="d-flex align-items-center gap-3">
                            <span class="avg-rating">5.0</span>
                            <div class="d-flex flex-column">
                                <div class="rating mb-2">
                                    <i class="ph ph-star ph-fill"></i>
                                    <i class="ph ph-star ph-fill"></i>
                                    <i class="ph ph-star ph-fill"></i>
                                    <i class="ph ph-star ph-fill"></i>
                                    <i class="ph ph-star ph-fill"></i>
                                </div>
                                <span class="rating-number">1 Review</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex d-sm-none flex-column gap-5 mt-3">
                    <div class="bars">
                        <div class="d-flex align-items-center gap-3">
                            <span class="rating-number">5 stars</span>
                            <div class="rating-background">
                                <div class="rating-percentage" style="width: 100%"></div>
                            </div>
                            <span class="rating-number">1</span>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="rating-number">4 stars</span>
                            <div class="rating-background">
                                <div class="rating-percentage" style="width: 0%"></div>
                            </div>
                            <span class="rating-number">0</span>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="rating-number">3 stars</span>
                            <div class="rating-background">
                                <div class="rating-percentage" style="width: 0%"></div>
                            </div>
                            <span class="rating-number">0</span>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="rating-number">2 stars</span>
                            <div class="rating-background">
                                <div class="rating-percentage" style="width: 0%"></div>
                            </div>
                            <span class="rating-number">0</span>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="rating-number">1 stars</span>
                            <div class="rating-background">
                                <div class="rating-percentage" style="width: 0%"></div>
                            </div>
                            <span class="rating-number">0</span>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="catalog-divider my-4">
            <div class="rating mb-2">
                <i class="ph ph-star ph-fill"></i>
                <i class="ph ph-star ph-fill"></i>
                <i class="ph ph-star ph-fill"></i>
                <i class="ph ph-star ph-fill"></i>
                <i class="ph ph-star ph-fill"></i>
            </div>
            <p class="important-rating-text">My favourite!</p>
            <p class="important-rating-text">Katie</p>
            <p class="description-text">2 years ago</p>
            <p class="description-text">The Shaman lace up LV has been my absolute favorite shoe since it came out. The flexibility in the midsole, along with the downturn and edging ability make it such a great shoe for all types of terrain. The Shaman Lace LV fit my foot perfectly (1/2 size up from street size) straight out of the box and I was instantly comfortable trying hard wearing them. They are also amazingly comfortable for an aggressive shoe. Highly recommend trying these, especially if you enjoy small crimps and overhang!</p>
        </div>
    </section>
@endsection

@push('scripts')
<script src="{{ asset('js/basket_scripts.js') }}"></script>
@endpush
