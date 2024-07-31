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
        return view('catalog.category', compact('category'));
    }

    public function brand(Brand $brand)
    {
        return view('catalog.brand', compact('brand'));
    }

    public function product(Product $product)
    {
        $product->load('category', 'brand');

        return view('catalog.product', compact('product'));
    }
}
