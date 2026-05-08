@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/payment_and_delivery_page.css') }}">
@endpush

@section('content')
    <section class="payment-page py-5">
        <div id="total-data" data-pre-discount="{{ $cart->preDiscount() }}" data-post-discount="{{ $cart->postDiscount() }}"></div>
        <div class="container-fluid px-4 px-xl-5">
            <form id="payment" method="POST" action="{{ route('checkout.makeOrder') }}">
                @csrf
                <div class="row g-5">
                    <div class="col-12 col-xl-7">
                        <div class="checkout-options-section mb-5">
                            <h1 class="display-title mb-5">Payment and Delivery</h1>

                            <h2 class="summary-title mb-4">Delivery options</h2>

                            <div class="checkout-option-list">
                                @foreach($deliveryOptions as $deliveryOption)
                                    <label class="checkout-option">
                                        <input type="radio" name="delivery" class="form-check-input checkout-radio" data-price="{{ $deliveryOption->price }}" onchange="updateShippingCost()" value="{{ $deliveryOption->id }}" required>
                                        <span class="checkout-option-content">
                                            <span class="checkout-option-text-wrap">
                                                <span class="checkout-option-title">{{ $deliveryOption->name }}</span>
                                                <span class="checkout-option-text">{{ $deliveryOption->description }}</span>
                                            </span>
                                            <span class="checkout-option-price">{{ $deliveryOption->price == 0 ? 'Free' : $deliveryOption->price }}</span>
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="checkout-options-section">
                            <h2 class="summary-title mb-4">Payment options</h2>

                            <div class="checkout-option-list">
                                    @foreach($paymentOptions as $paymentOption)
                                    <div class="payment-option">
                                        <input type="radio" name="payment" id="payment_{{ $paymentOption->id }}" class="form-check-input checkout-radio" value="{{ $paymentOption->id }}" required>
                                        <label for="payment_{{ $paymentOption->id }}" class="checkout-option">
                                            <span class="checkout-option-content">
                                                <span class="checkout-option-text-wrap">
                                                    <span class="checkout-option-title">{{ $paymentOption->name}}</span>
                                                    <span class="checkout-option-text">{{ $paymentOption->description}}</span>
                                                </span>
                                            </span>
                                        </label>

                                        @if($paymentOption->name == "Credit / Debit Card")
                                            <div class="payment-extra-fields">
                                                <div class="row g-3 mt-2">
                                                    <div class="col-lg-6 col-md-6 col-12">
                                                        <label for="cardNumber" class="visually-hidden">Card Number</label>
                                                        <input type="text" name="card_number" id="cardNumber" class="form-control" placeholder="Card Number">
                                                    </div>
                                                    <div class="col-lg-6 col-md-6"></div>
                                                    <div class="col-lg-3 col-md-3 col-6">
                                                        <label for="expirationDate" class="visually-hidden">Expiration Date</label>
                                                        <input type="text" name="expiration_date" id="expirationDate" class="form-control" placeholder="Expiration Date">
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-6">
                                                        <label for="cvc" class="visually-hidden">CVC</label>
                                                        <input type="text" name="cvc" id="cvc" class="form-control" placeholder="CVC">
                                                    </div>
                                                    <div class="col-lg-6 col-md-3"></div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-xl-5 pt-4">
                        <aside class="summary-box p-4">
                            <h2 class="summary-title mb-5 text-center">Overview</h2>

                            <div class="summary-row mb-4">
                                <span>Subtotal plus shipping cost</span>
                                <span id="subtotal">{{ number_format($cart->preDiscount(),2) }}€</span>
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
                                <span id="total">{{ number_format($cart->postDiscount(),2) }}€</span>
                            </div>

                            <div class="text-center">
                                <button type="submit" form="payment" class="btn checkout-pill w-50">Make order</button>
                            </div>
                        </aside>
                    </div>
                </div>
            </form>
        </div>
    </section>

    @include('partials.trust_strip')
@endsection
