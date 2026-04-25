<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['product_id', 'cart_id', 'size', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function totalPrice()
    {
        return $this->product->finalPrice() * $this->quantity;
    }

    public function fullPrice()
    {
        return $this->product->price * $this->quantity;
    }
}
