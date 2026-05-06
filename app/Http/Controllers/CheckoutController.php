<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\DeliveryOption;
use App\Models\PaymentOption;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function address()
    {
        $userId = auth()->id();
        if ($userId == null) {
            $cart = Cart::where('session_token', session()->getId())->first();
        } else {
            $cart = Cart::where('user_id', $userId)->first();
        }

        return view('shopping_cart_and_order_pages.delivery_address_page', compact('cart'));
    }

    public function storeAddress(Request $request)
    {
        session(['checkout.address' => $request->only('first_name', 'last_name', 'country', 'postcode', 'city', 'street', 'street_number', 'email', 'phone')]);
        return redirect()->route('checkout.payment');
    }

    public function payment()
    {
        $paymentOptions = PaymentOption::all();
        $deliveryOptions = DeliveryOption::all();
        $userId = auth()->id();
        if ($userId == null) {
            $cart = Cart::where('session_token', session()->getId())->first();
        } else {
            $cart = Cart::where('user_id', $userId)->first();
        }

        return view('shopping_cart_and_order_pages.payment_and_delivery_page', compact('cart', 'paymentOptions', 'deliveryOptions'));
    }

    public function makeOrder(Request $request){
        $userId = auth()->id();
        $deliveryOption = DeliveryOption::find($request->delivery);
        $cardPaymentId = PaymentOption::where('name', 'Credit / Debit Card')->first()->id;
        if ($request->payment == $cardPaymentId) {
            $request->validate([
                'card_number' => 'required',
                'expiration_date' => 'required',
                'cvc' => 'required',
            ]);
        }
        if ($userId == null) {
            $cart = Cart::where('session_token', session()->getId())->first();
        } else {
            $cart = Cart::where('user_id', $userId)->first();
        }

        $order = Order::create([
            'user_id' => $userId,
            'payment_option_id' => $request->payment,
            'delivery_option_id' => $request->delivery,
            'total_price' => $cart->postDiscount() + $deliveryOption->price,
        ]);

        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'size' => $item->size,
                'quantity' => $item->quantity,
                'subtotal' => $item->totalPrice(),

            ]);
        }

        $cart->delete();
        return redirect()->route('home');

    }
}
