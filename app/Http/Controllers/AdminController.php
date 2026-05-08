<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
}
