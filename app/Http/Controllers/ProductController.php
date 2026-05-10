<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Tag;

class ProductController extends Controller
{
    public function detail($id)
    {
        $product = Product::with(['images', 'brand', 'tags'])->findOrFail($id);

        return view('product_pages.product_detail_page', compact('product'));
    }

    public function search()
    {
        $search = request('q');

        $query = Product::with(['brand', 'images']);

        if (! empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'ILIKE', '%'.$search.'%')
                    ->orWhere('brief_description', 'ILIKE', '%'.$search.'%')
                    ->orWhere('detailed_description', 'ILIKE', '%'.$search.'%')
                    ->orWhereHas('brand', function ($brandQuery) use ($search) {
                        $brandQuery->where('name', 'ILIKE', '%'.$search.'%');
                    });
            });
        }

        if (request()->filled('min_price')) {
            $query->whereRaw('price * (1 - discount_percent / 100.0) >= ?', [request('min_price')]);
        }

        if (request()->filled('max_price')) {
            $query->whereRaw('price * (1 - discount_percent / 100.0) <= ?', [request('max_price')]);
        }

        $colorProductIds = (clone $query)->pluck('id');

        if (request()->filled('color')) {
            $colors = request('color');

            if (! is_array($colors)) {
                $colors = [$colors];
            }

            $query->whereHas('tags', function ($q) use ($colors) {
                $q->whereIn('name', $colors);
            });
        }

        $brandProductIds = (clone $query)->pluck('id');

        if (request()->filled('brand')) {
            $brands = request('brand');

            if (! is_array($brands)) {
                $brands = [$brands];
            }

            $query->whereHas('brand', function ($q) use ($brands) {
                $q->whereIn('name', $brands);
            });
        }

        $sizeProductIds = (clone $query)->pluck('id');

        if (request()->filled('size')) {
            $sizes = request('size');

            if (! is_array($sizes)) {
                $sizes = [$sizes];
            }

            $query->whereHas('tags', function ($q) use ($sizes) {
                $q->whereIn('name', $sizes);
            });
        }

        $sort = request('sort');

        if ($sort === 'price_asc') {
            $query->orderByRaw('price * (1 - discount_percent / 100.0) asc');
        } elseif ($sort === 'price_desc') {
            $query->orderByRaw('price * (1 - discount_percent / 100.0) desc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(8)->withQueryString();

        $colorTags = Tag::where('type', 'color')
            ->whereHas('products', function ($q) use ($colorProductIds) {
                $q->whereIn('products.id', $colorProductIds);
            })
            ->orderBy('name')
            ->get();

        $brands = Brand::whereHas('products', function ($q) use ($brandProductIds) {
            $q->whereIn('products.id', $brandProductIds);
        })
            ->orderBy('name')
            ->get();

        $adultShoeSizeTags = Tag::where('type', 'adult_shoe_size')
            ->whereHas('products', function ($q) use ($sizeProductIds) {
                $q->whereIn('products.id', $sizeProductIds);
            })
            ->get()
            ->sortBy(function ($tag) {
                return (float) $tag->name;
            });

        $kidsShoeSizeTags = Tag::where('type', 'kids_shoe_size')
            ->whereHas('products', function ($q) use ($sizeProductIds) {
                $q->whereIn('products.id', $sizeProductIds);
            })
            ->get()
            ->sortBy(function ($tag) {
                return (float) $tag->name;
            });

        $clothingSizeOrder = ['XXS', 'XS', 'S', 'M', 'L', 'XL'];

        $adultClothingSizeTags = Tag::where('type', 'adult_clothing_size')
            ->whereHas('products', function ($q) use ($sizeProductIds) {
                $q->whereIn('products.id', $sizeProductIds);
            })
            ->get()
            ->sortBy(function ($tag) use ($clothingSizeOrder) {
                return array_search($tag->name, $clothingSizeOrder);
            });

        $kidsClothingSizeTags = Tag::where('type', 'kids_clothing_size')
            ->whereHas('products', function ($q) use ($sizeProductIds) {
                $q->whereIn('products.id', $sizeProductIds);
            })
            ->get()
            ->sortBy(function ($tag) {
                return (int) $tag->name;
            });

        return view('product_pages.search_results', [
            'products' => $products,
            'search' => $search,
            'colorTags' => $colorTags,
            'adultShoeSizeTags' => $adultShoeSizeTags,
            'kidsShoeSizeTags' => $kidsShoeSizeTags,
            'adultClothingSizeTags' => $adultClothingSizeTags,
            'kidsClothingSizeTags' => $kidsClothingSizeTags,
            'brands' => $brands,
        ]);
    }

    public function categoryPage(string $page)
    {
        $pages = [
            'women' => [
                'slug' => 'women',
                'title' => 'WOMEN',
                'subtitle' => 'Climbing shoes and accessories designed for comfort, control, and power.',
                'heroClass' => 'category-hero-women',
                'type' => 'tag',
                'value' => 'Women',
                'shortcuts' => ['Shoes', 'Clothing', 'Equipment', 'Sale'],
            ],
            'men' => [
                'slug' => 'men',
                'title' => 'MEN',
                'subtitle' => 'Performance footwear and climbing essentials built for precision and support',
                'heroClass' => 'category-hero-men',
                'type' => 'tag',
                'value' => 'Men',
                'shortcuts' => ['Shoes', 'Clothing', 'Equipment', 'Sale'],
            ],
            'kids' => [
                'slug' => 'kids',
                'title' => 'KIDS',
                'subtitle' => 'Reliable footwear and apparel made for big adventures and growth',
                'heroClass' => 'category-hero-kids',
                'type' => 'tag',
                'value' => 'Kids',
                'shortcuts' => ['Shoes', 'Clothing', 'Equipment', 'Sale'],
            ],
            'sale' => [
                'slug' => 'sale',
                'title' => 'SALE',
                'subtitle' => 'Outlet finds built for real climbing days',
                'heroClass' => 'category-hero-sale',
                'type' => 'sale',
                'value' => null,
                'shortcuts' => ['Shoes', 'Clothing', 'Equipment'],
            ],
            'equipment' => [
                'slug' => 'equipment',
                'title' => 'EQUIPMENT',
                'subtitle' => 'Climbing equipment and essentials built for durability and control',
                'heroClass' => 'category-hero-equipment',
                'type' => 'category',
                'value' => 'Equipment',
                'shortcuts' => ['Chalk Bags', 'Helmets', 'Harnesses', 'Ropes', 'Sale'],
            ],
        ];

        abort_if(! isset($pages[$page]), 404);

        $pageData = $pages[$page];

        $query = Product::query();

        if ($pageData['type'] === 'tag') {
            $query->whereHas('tags', function ($q) use ($pageData) {
                $q->where('name', $pageData['value']);
            });
        }

        if ($pageData['type'] === 'category') {
            $query->whereHas('category', function ($q) use ($pageData) {
                $q->where('name', $pageData['value'])
                    ->orWhereHas('parent', function ($parentQuery) use ($pageData) {
                        $parentQuery->where('name', $pageData['value']);
                    });
            });
        }

        if ($pageData['type'] === 'sale') {
            $query->where('discount_percent', '>', 0);
        }

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
            $query->where('discount_percent', '>', 0);
        }

        if (request()->filled('min_price')) {
            $query->where('price', '>=', request('min_price'));
        }

        if (request()->filled('max_price')) {
            $query->where('price', '<=', request('max_price'));
        }

        $colorProductIds = (clone $query)->pluck('id');

        if (request()->filled('color')) {
            $colors = request('color');

            if (! is_array($colors)) {
                $colors = [$colors];
            }

            $query->whereHas('tags', function ($q) use ($colors) {
                $q->whereIn('name', $colors);
            });
        }

        $brandProductIds = (clone $query)->pluck('id');

        if (request()->filled('brand')) {
            $brands = request('brand');

            if (! is_array($brands)) {
                $brands = [$brands];
            }

            $query->whereHas('brand', function ($q) use ($brands) {
                $q->whereIn('name', $brands);
            });
        }

        $sizeProductIds = (clone $query)->pluck('id');

        if (request()->filled('size')) {
            $sizes = request('size');

            if (! is_array($sizes)) {
                $sizes = [$sizes];
            }

            $query->whereHas('tags', function ($q) use ($sizes) {
                $q->whereIn('name', $sizes);
            });
        }

        $sort = request('sort', 'newest');

        if ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(8)->withQueryString();

        $colorTags = Tag::where('type', 'color')
            ->whereHas('products', function ($q) use ($colorProductIds) {
                $q->whereIn('products.id', $colorProductIds);
            })
            ->orderBy('name')
            ->get();

        $brands = Brand::whereHas('products', function ($q) use ($brandProductIds) {
            $q->whereIn('products.id', $brandProductIds);
        })
            ->orderBy('name')
            ->get();

        $adultShoeSizeTags = Tag::where('type', 'adult_shoe_size')
            ->whereHas('products', function ($q) use ($sizeProductIds) {
                $q->whereIn('products.id', $sizeProductIds);
            })
            ->get()
            ->sortBy(function ($tag) {
                return (float) $tag->name;
            });

        $kidsShoeSizeTags = Tag::where('type', 'kids_shoe_size')
            ->whereHas('products', function ($q) use ($sizeProductIds) {
                $q->whereIn('products.id', $sizeProductIds);
            })
            ->get()
            ->sortBy(function ($tag) {
                return (float) $tag->name;
            });

        $clothingSizeOrder = ['XXS', 'XS', 'S', 'M', 'L', 'XL'];

        $adultClothingSizeTags = Tag::where('type', 'adult_clothing_size')
            ->whereHas('products', function ($q) use ($sizeProductIds) {
                $q->whereIn('products.id', $sizeProductIds);
            })
            ->get()
            ->sortBy(function ($tag) use ($clothingSizeOrder) {
                return array_search($tag->name, $clothingSizeOrder);
            });

        $kidsClothingSizeTags = Tag::where('type', 'kids_clothing_size')
            ->whereHas('products', function ($q) use ($sizeProductIds) {
                $q->whereIn('products.id', $sizeProductIds);
            })
            ->get()
            ->sortBy(function ($tag) {
                return (int) $tag->name;
            });

        return view('product_pages.category_page', [
            'page' => $pageData,
            'products' => $products,
            'colorTags' => $colorTags,
            'adultShoeSizeTags' => $adultShoeSizeTags,
            'kidsShoeSizeTags' => $kidsShoeSizeTags,
            'adultClothingSizeTags' => $adultClothingSizeTags,
            'kidsClothingSizeTags' => $kidsClothingSizeTags,
            'brands' => $brands,
        ]);
    }
}
