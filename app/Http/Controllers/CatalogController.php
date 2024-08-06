<?php

namespace App\Http\Controllers;

use App\Helpers\ProductFilter;
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

    public function category(Category $category, ProductFilter $filters)
    {
        $products = Product::categoryProducts($category->id)
            ->filterProducts($filters)
            ->paginate(6)
            ->withQueryString();

        return view('catalog.category', compact('category', 'products'));
    }

    public function brand(Brand $brand, ProductFilter $filters)
    {
        $products = $brand
            ->products()
            ->filterProducts($filters)
            ->paginate(6)
            ->withQueryString();
        return view('catalog.brand', compact('brand', 'products'));
    }

    public function product(Product $product)
    {
        $product->load('category', 'brand');

        return view('catalog.product', compact('product'));
    }

    public function search(Request $request)
    {
        $search = $request->input('query');
        $query = Product::search($search);
        $products = $query->paginate(6)->withQueryString();
        return view('catalog.search', compact('products', 'search'));
    }
}
