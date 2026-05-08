@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/shopping_cart.css') }}">
@endpush

@section('content')
    @if(!$cart || $cart->items->isEmpty())
        <section class="cart-page py-5">
            <div class="text-center mb-5">
                <h1 class="display-title">Cart Empty</h1>
            </div>
        </section>
    @else
        <section class="cart-page py-5">
            <div class="container-fluid px-4 px-xl-5">
                <div class="text-center mb-5">
                    <h1 class="display-title">Shopping Cart</h1>
                </div>

                <div class="row g-5">
                    <div class="col-12 col-xl-8">
                        <div class="row mt-5 mb-3 d-none d-lg-flex">
                            <div class="col-md-7"></div>
                            <div class="col-md-3 text-center">
                                <h2 class="cart-section-label mb-0">Quantity</h2>
                            </div>
                            <div class="col-md-1 text-center">
                                <h2 class="cart-section-label mb-0">Total</h2>
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        @foreach($cart->items as $item)
                            <article class="cart-item py-4">
                                <div class="row gy-4">
                                    <div class="col-12">
                                        <div class="row align-items-start">
                                            <div class="col-5 col-md-3">
                                                <img src="{{ asset($item->product->images->sortBy('sort_order')->first()->image_url ?? 'images/placeholder.jpg') }}"
                                                     class="cart-item-img"
                                                     alt="{{ $item->product->images->sortBy('sort_order')->first()->alt_text ?? $product->name }}">
                                            </div>

                                            <div class="col-7 col-md-4">
                                                <h2 class="cart-item-title mb-3">{{ $item->product->name }}</h2>
                                                <p class="mb-2"><strong>Color</strong> <span class="ms-2 text-muted">{{ $item->product->color }}</span></p>
                                                <p class="mb-0"><strong>Size</strong> <span class="ms-2 text-muted">{{ $item->size }}</span></p>
                                            </div>

                                            <div class="d-none d-md-block col-md-3 text-center">
                                                <form method="POST" action="{{ route('cart.update') }}">
                                                    @csrf
                                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                                    <div class="quantity-control">
                                                        <button type="submit" name="change" value="-1" class="quantity-btn-small">-</button>
                                                        <span class="quantity-value">{{ $item->quantity }}</span>
                                                        <button type="submit" name="change" value="1" class="quantity-btn-small">+</button>
                                                    </div>
                                                </form>
                                            </div>

                                            @if($item->product->tags->contains('name','Sale'))
                                                <div class="d-none d-md-block col-md-1 text-center">
                                                    <p class="cart-price old-price mb-1">{{ number_format($item->fullPrice(),2) }}€</p>
                                                    <p class="cart-price mb-0">{{ number_format($item->totalPrice(),2) }}€</p>
                                                </div>
                                            @else
                                            <div class="d-none d-md-block col-md-1 text-center">
                                                <p class="cart-price mb-0">{{ number_format($item->totalPrice(),2) }}€</p>
                                            </div>
                                            @endif
                                            <div class="d-none d-md-block col-md-1 text-end">
                                                <form method="POST" action="{{ route('cart.delete') }}">
                                                    @csrf
                                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                                    <button type="submit" class="remove-btn" aria-label="Remove item">
                                                        <i class="ph ph-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 d-md-none">
                                        <div class="row align-items-center text-center">
                                            <div class="col-5">
                                                <div class="fw-semibold mb-2">Quantity</div>
                                                <form method="POST" action="{{ route('cart.update') }}">
                                                    @csrf
                                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                                    <div class="quantity-control">
                                                        <button type="submit" name="change" value="-1" class="quantity-btn-small">-</button>
                                                        <span class="quantity-value">{{ $item->quantity }}</span>
                                                        <button type="submit" name="change" value="1" class="quantity-btn-small">+</button>
                                                    </div>
                                                </form>
                                            </div>

                                            @if($item->product->tags->contains('name','Sale'))
                                            <div class="col-4">
                                                <div class="fw-semibold mb-2">Total</div>
                                                <p class="cart-price old-price mb-1">{{ number_format($item->fullPrice(),2) }}€</p>
                                                <p class="cart-price mb-0">{{ number_format($item->totalPrice(),2) }}€</p>
                                            </div>
                                            @else
                                            <div class="col-4">
                                                <div class="fw-semibold mb-2">Total</div>
                                                <p class="cart-price mb-0">{{ number_format($item->totalPrice(),2) }}€</p>
                                            </div>
                                            @endif

                                            <div class="col-3 text-end">
                                                <form method="POST" action="{{ route('cart.delete') }}">
                                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                                    @csrf
                                                    <button type="submit" class="remove-btn" aria-label="Remove item">
                                                        <i class="ph ph-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="col-12 col-xl-4 pt-5">
                        <aside class="summary-box p-4">
                            <h2 class="summary-title mb-5 text-center">Overview</h2>

                            <div class="summary-row mb-4">
                                <span>Subtotal plus shipping cost</span>
                                <span>{{ number_format($cart->preDiscount(),2) }}€</span>
                            </div>

                            @php
                                $saleItems = $cart->discountedItems();
                            @endphp
                            <div class="summary-row mb-4">
                                <span>
                                    Discounts<br>
                                    @if($saleItems->isEmpty())
                                        Does not apply<br>
                                    @else
                                        Sale<br>
                                    @endif
                                    @foreach($saleItems as $saleItem)
                                        <span class="summary-note">{{ $saleItem->product->name }}</span><br>
                                    @endforeach
                                </span>
                                <span>{{ number_format($cart->preDiscount() - $cart->postDiscount(),2) }}€</span>
                            </div>

                            <div class="summary-row summary-total mb-4">
                                <span>Total</span>
                                <span>{{ number_format($cart->postDiscount(),2) }}€</span>
                            </div>

                            <a href="{{ route('checkout.address') }}" class="btn checkout-pill w-100 mt-3">Proceed to checkout</a>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @include('partials.trust_strip')
@endsection
