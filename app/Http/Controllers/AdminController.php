<?php

namespace App\Http\Controllers;

use App\Models\Product;

class AdminController extends Controller
{
    public function inventory(){
        $products = Product::all();
        return view('admin.main_interface', compact('products'));
    }
}
