<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'color',
        'brand_id',
        'category_id',
        'price',
        'discount_percent',
        'brief_description',
        'detailed_description',
        'features_specifications',
        'stock_quantity',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function finalPrice()
    {
        return $this->discount_percent > 0 ? $this->price * (1 - $this->discount_percent / 100) : $this->price;
    }

    public function getFeaturesAttribute()
    {
        return preg_split('/\n|\r\n|\r/', $this->features_specifications);
    }
}
