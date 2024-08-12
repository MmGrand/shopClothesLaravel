<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Helpers\ProductFilter;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function index(): View
    {
        $categories = Category::where('parent_id', 0)->get();
        $brands = Brand::popular();

        $breadcrumbs = [
            ['title' => __('Главная'), 'href' => route('home')],
            ['title' => __('Каталог')]
        ];

        return view('site.catalog.index', compact('categories', 'brands', 'breadcrumbs'));
    }

    public function category(Category $category, ProductFilter $filters): View
    {
        $products = Product::categoryProducts($category->id)
            ->filterProducts($filters)
            ->paginate(6)
            ->withQueryString();

        $breadcrumbs = [
            ['title' => __('Главная'), 'href' => route('home')],
            ['title' => __('Каталог'), 'href' => route('catalog.index')],
            ['title' => $category->name]
        ];

        return view('site.catalog.category', compact('category', 'products', 'breadcrumbs'));
    }

    public function brand(Brand $brand, ProductFilter $filters): View
    {
        $products = $brand
            ->products()
            ->filterProducts($filters)
            ->paginate(6)
            ->withQueryString();

        $breadcrumbs = [
            ['title' => __('Главная'), 'href' => route('home')],
            ['title' => __('Каталог'), 'href' => route('catalog.index')],
            ['title' => $brand->name]
        ];

        return view('site.catalog.brand', compact('brand', 'products', 'breadcrumbs'));
    }

    public function product(Product $product): View
    {
        $product->load('category', 'brand');

        $breadcrumbs = [
            ['title' => __('Главная'), 'href' => route('home')],
            ['title' => __('Каталог'), 'href' => route('catalog.index')],
            ['title' => $product->name]
        ];

        return view('site.catalog.product', compact('product', 'breadcrumbs'));
    }

    public function search(Request $request): View
    {
        $search = $request->input('query');
        $query = Product::search($search);
        $products = $query->paginate(6)->withQueryString();

        return view('site.catalog.search', compact('products', 'search'));
    }
}
