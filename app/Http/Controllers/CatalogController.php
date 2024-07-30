<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_id', 0)->get();

        return view('catalog.index', compact('categories'));
    }

    public function category(Category $category)
    {
        $products = Product::where('category_id', $category->id)->get();

        return view('catalog.category', compact('category', 'products'));
    }

    public function brand(Brand $brand)
    {
        $products = Product::where('category_id', $brand->id)->get();

        return view('catalog.brand', compact('brand', 'products'));
    }

    public function product(Product $product)
    {
        $product->load('category', 'brand');

        return view('catalog.product', compact('product'));
    }
}
