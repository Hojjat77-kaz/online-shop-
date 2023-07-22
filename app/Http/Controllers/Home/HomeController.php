<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $sliders = Banner::where('type','slider')->where('is_active' , 1)->orderBy('priority')->get();
        $bannersTopIndex = Banner::where('type','index_top')->where('is_active' , 1)->orderBy('priority')->get();
        $bannersBottomIndex = Banner::where('type','index_bottom')->where('is_active' , 1)->orderBy('priority')->get();
        $products = Product::where('is_active' , 1)->get();

        return view('home.index',compact('sliders','bannersTopIndex','bannersBottomIndex','products'));
    }
}
