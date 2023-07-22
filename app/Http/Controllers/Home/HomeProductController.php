<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeProductController extends Controller
{
    public function show(Product $product){
        return view('home.products.show', compact('product'));
    }
}
