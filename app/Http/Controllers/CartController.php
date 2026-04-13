<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $userId = auth()->id();
        $cart = Cart::firstOrCreate([
            'user_id' => $userId,
            'session_token' => $userId ? null : $request->session()->getId(),
        ]);

        $size = $request->size ?? 'universal';

        $item = CartItem::where([
            'product_id' => $request->product_id,
            'cart_id' => $cart->id,
            'size' => $size,
        ])->first();

        if ($item) {
            $item->quantity = $item->quantity + $request->quantity;
            $item->save();
        } else {
            CartItem::create([
                'product_id' => $request->product_id,
                'cart_id' => $cart->id,
                'size' => $size,
                'quantity' => $request->quantity,
            ]);
        }

        return back();
    }

    public function cart()
    {
        $userId = auth()->id();
        if ($userId == null) {
            $cart = Cart::where('session_token', session()->getId())->first();
        } else {
            $cart = Cart::where('user_id', $userId)->first();
        }

        return view('shopping_cart_and_order_pages.shopping_cart', compact('cart'));
    }

    public function update(Request $request)
    {
        $item = CartItem::find($request->item_id);
        if ($item) {
            $item->quantity += $request->change;
            if ($item->quantity < 1) {
                $item->delete();
                return back();
            }
            $item->save();
            return back();
        }
        return back();
    }

    public function delete(Request $request)
    {
        $item = CartItem::find($request->item_id);
        if ($item) {
            $item->delete();
            return back();
        }
        return back();
    }
}
