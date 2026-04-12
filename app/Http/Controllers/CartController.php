<?php

namespace App\Http\Controllers;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $userId = auth()->id();
        $cart = Cart::firstOrCreate([
            'user_id' => $userId,
            'session_token' => $userId ? null : $request->session()->getId(),
        ]);

        $item = CartItem::where([
            'product_id' => $request->product_id,
            'cart_id' => $cart->id,
            'size' => $request->size,
        ])->first();

        if ($item) {
            $item->quantity = $item->quantity + $request->quantity;
            $item->save();
        } else {
            CartItem::create([
                'product_id' => $request->product_id,
                'cart_id' => $cart->id,
                'size' => $request->size,
                'quantity' => $request->quantity,
            ]);
        }

        return back()->with('success', 'Item added to cart');
    }
}
