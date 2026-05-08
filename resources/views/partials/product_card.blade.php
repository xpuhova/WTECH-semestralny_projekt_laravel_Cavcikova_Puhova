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
