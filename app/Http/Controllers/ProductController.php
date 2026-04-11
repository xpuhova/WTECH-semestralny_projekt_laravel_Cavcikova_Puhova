<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Tag;

class ProductController extends Controller
{
    public function women()
    {
        $tag = Tag::where('name', 'Women')->firstOrFail();

        $query = Product::with(['brand', 'images'])
            ->whereHas('tags', function ($q) use ($tag) {
                $q->where('tags.id', $tag->id);
            });

        if (request()->filled('category')) {
            $categoryName = request('category');

            $query->whereHas('category', function ($q) use ($categoryName) {
                $q->where('name', $categoryName)
                    ->orWhereHas('parent', function ($parentQuery) use ($categoryName) {
                        $parentQuery->where('name', $categoryName);
                    });
            });
        }

        if (request()->filled('sale')) {
            $query->whereHas('tags', function ($q) {
                $q->where('name', 'Sale');
            });
        }

        if (request()->filled('min_price')) {
            $query->where('price', '>=', request('min_price'));
        }

        if (request()->filled('max_price')) {
            $query->where('price', '<=', request('max_price'));
        }

        if (request()->filled('color')) {
            $colors = request('color');

            if (! is_array($colors)) {
                $colors = [$colors];
            }

            $query->whereHas('tags', function ($q) use ($colors) {
                $q->whereIn('name', $colors);
            });
        }

        if (request()->filled('size')) {
            $sizes = request('size');

            if (! is_array($sizes)) {
                $sizes = [$sizes];
            }

            $query->whereHas('tags', function ($q) use ($sizes) {
                $q->whereIn('name', $sizes);
            });
        }

        if (request()->filled('brand')) {
            $brands = request('brand');

            if (! is_array($brands)) {
                $brands = [$brands];
            }

            $query->whereHas('brand', function ($q) use ($brands) {
                $q->whereIn('name', $brands);
            });
        }

        $sort = request('sort');

        if ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(8)->withQueryString();

        $colorTags = Tag::where('type', 'color')->orderBy('name')->get();

        $shoeSizeTags = Tag::where('type', 'shoe_size')->get()
            ->sortBy(function ($tag) {
                return (float) $tag->name;
            });

        $clothingSizeOrder = ['XXS', 'XS', 'S', 'M', 'L', 'XL'];

        $clothingSizeTags = Tag::where('type', 'clothing_size')->get()
            ->sortBy(function ($tag) use ($clothingSizeOrder) {
                return array_search($tag->name, $clothingSizeOrder);
            });

        $brands = Brand::orderBy('name')->get();

        return view('product_pages.womens_page', [
            'products' => $products,
            'colorTags' => $colorTags,
            'shoeSizeTags' => $shoeSizeTags,
            'clothingSizeTags' => $clothingSizeTags,
            'brands' => $brands,
        ]);
    }
}
