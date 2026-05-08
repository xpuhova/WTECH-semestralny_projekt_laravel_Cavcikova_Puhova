<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Brand;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function inventory(Request $request){
        $search = $request->search;
        $query = Product::query();
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
        $products = $query->get();
        return view('admin.main_interface', compact('products'));
    }

    public function edit($id){
        $product = Product::with(['images', 'brand', 'tags'])->findOrFail($id);
        $mainCategories = Category::with('children')->whereNull('parent_category_id')->get();
        $tags = Tag::all()->groupBy('type');
        $brands = Brand::all();

        return view('admin.edit_interface', compact('product', 'mainCategories', 'tags', 'brands'));
    }
}
