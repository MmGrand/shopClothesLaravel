<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
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

        return view('site.catalog.index', compact('categories', 'brands'));
    }

    public function category(Category $category, ProductFilter $filters)
    {
        $products = Product::categoryProducts($category->id)
            ->filterProducts($filters)
            ->paginate(6)
            ->withQueryString();

        return view('site.catalog.category', compact('category', 'products'));
    }

    public function brand(Brand $brand, ProductFilter $filters)
    {
        $products = $brand
            ->products()
            ->filterProducts($filters)
            ->paginate(6)
            ->withQueryString();
        return view('site.catalog.brand', compact('brand', 'products'));
    }

    public function product(Product $product)
    {
        $product->load('category', 'brand');

        return view('site.catalog.product', compact('product'));
    }

    public function search(Request $request)
    {
        $search = $request->input('query');
        $query = Product::search($search);
        $products = $query->paginate(6)->withQueryString();
        return view('site.catalog.search', compact('products', 'search'));
    }
}
