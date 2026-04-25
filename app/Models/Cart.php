<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'session_token'];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function discountedItems()
    {
        return $this->items->filter(function ($item) {
            return $item->product->tags->contains('name', 'Sale');
        });
    }
    public function preDiscount()
    {
        return $this->items->sum->fullPrice();
    }

    public function postDiscount()
    {
        return $this->items->sum->totalPrice();
    }
}
