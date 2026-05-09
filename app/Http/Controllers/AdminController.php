<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function inventory(Request $request)
    {
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

    public function edit($id)
    {
        $product = Product::with(['images', 'brand', 'tags'])->findOrFail($id);
        $mainCategories = Category::with('children')->whereNull('parent_category_id')->get();
        $tags = Tag::all()->groupBy('type');
        $brands = Brand::all();

        return view('admin.edit_interface', compact('product', 'mainCategories', 'tags', 'brands'));
    }

    public function new()
    {
        $mainCategories = Category::with('children')->whereNull('parent_category_id')->get();
        $tags = Tag::all()->groupBy('type');
        $brands = Brand::all();

        return view('admin.add_interface', compact('mainCategories', 'tags', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        $product->update([
            'name' => $request->product_name,
            'price' => $request->product_price,
            'color' => $request->product_color,
            'discount_percent' => $request->product_discount,
            'brief_description' => $request->brief_description,
            'detailed_description' => $request->detailed_description,
            'features_specifications' => $request->features,
            'brand_id' => $request->brand_id,
            'category_id' => $request->sub_category ?? $request->category,
        ]);

        if ($request->existing_images) {
            foreach ($request->existing_images as $imageId => $data) {
                ProductImage::where('id', $imageId)->update([
                    'alt_text' => $data['alt_text'],
                    'sort_order' => $data['sort_order'],
                ]);
            }
        }

        if ($request->remove_images) {
            ProductImage::whereIn('id', $request->remove_images)->delete();
        }

        if ($request->hasFile('new_images')) {
            $meta = $request->input('new_images');
            $removed = $request->input('remove_new_images', []);

            foreach ($request->file('new_images') as $index => $file) {
                if (in_array($index, $removed)) {
                    continue;
                }
                $path = $file->store('images', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => 'storage/'.$path,
                    'alt_text' => $meta[$index]['alt_text'],
                    'sort_order' => $meta[$index]['sort_order'],
                ]);
            }
        }

        $product->tags()->sync($request->input('tags', []));

        return redirect()->route('admin.inventory');
    }

    public function add(Request $request)
    {
        $product = Product::create([
            'name' => $request->product_name,
            'price' => $request->product_price,
            'color' => $request->product_color,
            'discount_percent' => $request->product_discount,
            'brief_description' => $request->brief_description,
            'detailed_description' => $request->detailed_description,
            'features_specifications' => $request->features,
            'brand_id' => $request->brand_id,
            'category_id' => $request->sub_category ?? $request->category,
        ]);

        $product->tags()->sync($request->input('tags', []));

        if ($request->hasFile('new_images')) {
            $meta = $request->input('new_images');
            $removed = $request->input('remove_new_images', []);

            foreach ($request->file('new_images') as $index => $file) {
                if (in_array((string)$index, $removed)) {
                    continue;
                }
                $file->move(public_path('images'), $file->getClientOriginalName());

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url'  => 'images/'.$file->getClientOriginalName(),
                    'alt_text'   => $meta[$index]['alt_text'],
                    'sort_order' => $meta[$index]['sort_order'],
                ]);
            }
        }

        return redirect()->route('admin.inventory');
    }

    public function delete($id) {
        $product = Product::where('id', $id)->firstOrFail();
        foreach ($product->images as $image) {
            $path = public_path($image->image_url);
            if (file_exists($path)) {
                unlink($path);
            }
        }
        $product->delete();

        return redirect()->route('admin.inventory');
    }
}
