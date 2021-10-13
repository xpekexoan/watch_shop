<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Color;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ProductController extends Controller
{
    protected $limit;

    public function __construct() {
        $this->limit = 9;
    }

    public function index()
    {
        $products = Product::paginate($this->limit);
        $categories = Category::where('status', true)->get();
        $brands = Brand::where('status', true)->get();
        $colors = Color::all();
        return view('user.product.index', compact('products', 'categories', 'brands', 'colors'));
    }

    public function detail($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        $product['image_detail'] = json_decode($product->image_detail) ?? [];
        $colors = Color::all();
        return view('user.product.detail', compact('product', 'categories', 'brands', 'colors'));
    }

    public function search(Request $request)
    {
        $name = $request->q;
        $categories = Category::where('status', true)->get();
        $brands = Brand::where('status', true)->get();
        $colors = Color::all();
        $products = Product::where('name', 'like', "%$name%")->paginate($this->limit);
        return view('user.product.index', compact('products', 'categories', 'brands', 'colors'));
    }
}
