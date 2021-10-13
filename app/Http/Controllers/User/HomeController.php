<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Blog;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller
{
    public function index()
    {
        $product_sale = Product::all()->random(5);
        $product_new = Product::all()->random(5);
        $product_best = Product::all()->random(5);
        $product_intro = Product::all()->random(1)->first();
        $brands = Brand::all();
        $blogs = Blog::orderby('created_at', 'desc')->take(3)->get();
        return view('user.home.index', compact('product_sale', 'product_new', 'product_best', 'product_intro', 'brands','blogs'));
    }
}
