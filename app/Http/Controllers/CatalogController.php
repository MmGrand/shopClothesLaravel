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
        $brands = Brand::popular();

        return view('catalog.index', compact('categories', 'brands'));
    }

    public function category(Category $category)
    {
        $descendants = $category->getAllChildren($category->id);
        $descendants[] = $category->id;
        $products = Product::whereIn('category_id', $descendants)->paginate(6);

        return view('catalog.category', compact('category', 'products'));
    }

    public function brand(Brand $brand)
    {
        $products = $brand->products()->paginate(6);
        return view('catalog.brand', compact('brand', 'products'));
    }

    public function product(Product $product)
    {
        $product->load('category', 'brand');

        return view('catalog.product', compact('product'));
    }
}
