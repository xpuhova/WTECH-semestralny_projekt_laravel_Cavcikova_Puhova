<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'payment_option_id', 'delivery_option_id', 'total_price'];
}
