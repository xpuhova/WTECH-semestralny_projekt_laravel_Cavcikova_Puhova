<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;

class ProductController extends Controller
{
    public function women()
    {
        $tag = Tag::where('name', 'Women')->firstOrFail();

        $products = Product::with(['brand', 'images'])
            ->whereHas('tags', function ($query) use ($tag) {
                $query->where('tags.id', $tag->id);
            })
            ->paginate(8);

        return view('product_pages.womens_page', [
            'products' => $products,
        ]);
    }
}
