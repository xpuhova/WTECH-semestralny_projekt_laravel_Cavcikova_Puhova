<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'session_token',
    ];
    //

    public function items()
    {
        return $this->hasMany(CartItem::class);
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
