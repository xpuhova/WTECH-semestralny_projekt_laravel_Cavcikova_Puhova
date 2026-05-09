@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/delivery_address_page.css') }}">
@endpush

@section('content')
    <section class="checkout-page py-5">
        <div class="container-fluid px-4 px-xl-5">
            <div class="row g-5">
                <div class="col-12 col-xl-7">
                    <div class="checkout-form-area">
                        <h1 class="display-title mb-5">Delivery Address</h1>
                        @if(is_null(auth()->id()))
                            <form id="address" method="POST" action="{{ route('checkout.storeAddress') }}" autocomplete="on">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-12 col-md-6">
                                        <label for="firstName" class="visually-hidden">First Name</label>
                                        <input type="text" name="first_name" id="firstName" value="{{ old('first_name') }}" class="form-control checkout-input" placeholder="First Name">
                                        @error('first_name')
                                        <p class="text-danger mt-1 mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label for="lastName" class="visually-hidden">Last Name</label>
                                        <input type="text" name="last_name" id="lastName" value="{{ old('last_name') }}" class="form-control checkout-input" placeholder="Last Name">
                                        @error('last_name')
                                        <p class="text-danger mt-1 mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="country" class="visually-hidden">Country</label>
                                        <select name="country" id="country" value="{{ old('country') }}" class="form-select checkout-input">
                                            <option value="" disabled selected>Country</option>
                                            <option>Slovakia</option>
                                            <option>Czech Republic</option>
                                            <option>Austria</option>
                                            <option>Germany</option>
                                        </select>
                                        @error('country')
                                        <p class="text-danger mt-1 mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <label for="postcode" class="visually-hidden">Postcode</label>
                                        <input type="text" name="postcode" id="postcode" value="{{ old('postcode') }}" class="form-control checkout-input" placeholder="Postcode">
                                        @error('postcode')
                                        <p class="text-danger mt-1 mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-8">
                                        <label for="city" class="visually-hidden">City</label>
                                        <input type="text" name="city" id="city" value="{{ old('city') }}" class="form-control checkout-input" placeholder="City">
                                        @error('city')
                                        <p class="text-danger mt-1 mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-8">
                                        <label for="street" class="visually-hidden">Street</label>
                                        <input type="text" name="street" id="street" value="{{ old('street') }}" class="form-control checkout-input" placeholder="Street">
                                        @error('street')
                                        <p class="text-danger mt-1 mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <label for="streetNo" class="visually-hidden">No.</label>
                                        <input type="text" name="street_no" id="streetNo" value="{{ old('street_no') }}" class="form-control checkout-input" placeholder="No.">
                                        @error('street_no')
                                        <p class="text-danger mt-1 mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="email" class="visually-hidden">Email</label>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control checkout-input" placeholder="Email">
                                        @error('email')
                                        <p class="text-danger mt-1 mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="phone" class="visually-hidden">Phone number</label>
                                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" class="form-control checkout-input" placeholder="Phone number">
                                        @error('phone')
                                        <p class="text-danger mt-1 mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </form>
                        @else
                            <form id="address" method="POST" action="{{ route('checkout.storeAddress') }}" autocomplete="on">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-12 col-md-6">
                                        <label for="firstName" class="visually-hidden">First Name</label>
                                        <input name="first_name" type="text" id="firstName" class="form-control checkout-input" placeholder="First Name"  value="{{ $cart->user->first_name }}">
                                        @error('first_name')
                                        <p class="text-danger mt-1 mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label for="lastName" class="visually-hidden">Last Name</label>
                                        <input name="last_name" type="text" id="lastName" class="form-control checkout-input" placeholder="Last Name" value="{{ $cart->user->last_name }}">
                                        @error('last_name')
                                        <p class="text-danger mt-1 mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="country" class="visually-hidden">Country</label>
                                        <select name="country" id="country" class="form-select checkout-input">
                                            <option value="" disabled selected>Country</option>
                                            <option value="Slovakia" {{$cart->user->country === 'Slovakia' ? 'selected' : ''}}>Slovakia</option>
                                            <option value="Czech Republic" {{$cart->user->country === 'Czech Republic' ? 'selected' : ''}}>Czech Republic</option>
                                            <option value="Austria" {{$cart->user->country === 'Austria' ? 'selected' : ''}}>Austria</option>
                                            <option value="Germany" {{$cart->user->country === 'Germany' ? 'selected' : ''}}>Germany</option>
                                        </select>
                                        @error('country')
                                        <p class="text-danger mt-1 mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <label for="postcode" class="visually-hidden">Postcode</label>
                                        <input name="postcode" type="text" id="postcode" class="form-control checkout-input" placeholder="Postcode" value="{{ $cart->user->postcode }}">
                                        @error('postcode')
                                        <p class="text-danger mt-1 mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-8">
                                        <label for="city" class="visually-hidden">City</label>
                                        <input name="city" type="text" id="city" class="form-control checkout-input" placeholder="City" value="{{ $cart->user->city }}">
                                        @error('city')
                                        <p class="text-danger mt-1 mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-8">
                                        <label for="street" class="visually-hidden">Street</label>
                                        <input name="street" type="text" id="street" class="form-control checkout-input" placeholder="Street" value="{{ $cart->user->street }}">
                                        @error('street')
                                        <p class="text-danger mt-1 mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <label for="streetNo" class="visually-hidden">No.</label>
                                        <input name="street_no" type="text" id="streetNo" class="form-control checkout-input" placeholder="No." value="{{ $cart->user->street_no }}">
                                        @error('street_no')
                                        <p class="text-danger mt-1 mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="email" class="visually-hidden">Email</label>
                                        <input name="email" type="email" id="email" class="form-control checkout-input" placeholder="Email" value="{{ $cart->user->email }}">
                                        @error('email')
                                        <p class="text-danger mt-1 mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="phone" class="visually-hidden">Phone number</label>
                                        <input name="phone" type="tel" id="phone" class="form-control checkout-input" placeholder="Phone number" value="{{ $cart->user->phone_number }}">
                                        @error('phone')
                                        <p class="text-danger mt-1 mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>

                <div class="col-12 col-xl-5 pt-4">
                    <aside class="summary-box p-4">
                        <h2 class="summary-title mb-5 text-center">Your Order</h2>

                        @foreach($cart->items as $item)
                            <div class="checkout-product mb-4">
                                <div class="row g-3 align-items-start">
                                    <div class="col-3">
                                        <img src="{{ asset($item->product->images->sortBy('sort_order')->first()->image_url ?? 'images/placeholder.jpg') }}"
                                             class="checkout-product-img"
                                             alt="{{ $item->product->images->sortBy('sort_order')->first()->alt_text ?? $product->name }}">
                                    </div>
                                    <div class="col-6">
                                        <h3 class="checkout-product-title mb-1">{{ $item->product->name }}</h3>
                                        <p class="checkout-product-meta mb-0">{{ $item->product->color }} | {{ $item->size }}</p>
                                    </div>
                                    @if($item->product->tags->contains('name','Sale'))
                                        <div class="col-3 text-end">
                                            <p class="checkout-product-price old-price mb-1">{{ number_format($item->fullPrice(),2) }}€</p>
                                            <p class="checkout-product-price mb-0">{{ number_format($item->totalPrice(),2) }}€</p>
                                        </div>
                                    @else
                                        <div class="col-3 text-end">
                                            <p class="checkout-product-price mb-0">{{ number_format($item->totalPrice(),2) }}€</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach

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
                        <div class="summary-row summary-total mb-5">
                            <span>Total</span>
                            <span>{{ number_format($cart->postDiscount(),2) }}€</span>
                        </div>

                        <div class="text-center">
                            <button type="submit" form="address" class="btn checkout-pill w-50">Continue</button>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>

    @include('partials.trust_strip')
@endsection
