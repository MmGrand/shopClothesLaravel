<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\ProductCatalogRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{

    private $imageSaver;

    public function __construct(ImageSaver $imageSaver)
    {
        $this->imageSaver = $imageSaver;
    }

    public function index(): View
    {
        $roots = Category::where('parent_id', 0)->get();
        $products = Product::paginate(5);

        return view('admin.product.index', compact('products', 'roots'));
    }

    public function create(): View
    {
        $items = Category::all();
        $brands = Brand::all();

        return view('admin.product.create', compact('items', 'brands'));
    }

    public function store(ProductCatalogRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['image'] = $this->imageSaver->upload($request, null, 'product');
        $data['views_count'] = $data['views_count'] ?? 0;

        $booleanFields = ['new', 'hit', 'sale', 'is_published'];
        foreach ($booleanFields as $field) {
            $data[$field] = $request->has($field);
        }

        $product = Product::create($data);

        return redirect()
            ->route('admin.product.show', ['product' => $product->slug])
            ->with('success', __('Новый товар успешно создан'));
    }

    public function show(Product $product): View
    {
        return view('admin.product.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        $items = Category::all();
        $brands = Brand::all();

        return view('admin.product.edit', compact('product', 'items', 'brands'));
    }

    public function update(ProductCatalogRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();
        $data['image'] = $this->imageSaver->upload($request, $product, 'product');
        $data['views_count'] = $data['views_count'] ?? 0;

        $booleanFields = ['new', 'hit', 'sale', 'is_published'];
        foreach ($booleanFields as $field) {
            $data[$field] = $request->has($field);
        }

        $product->update($data);

        return redirect()
            ->route('admin.product.show', ['product' => $product->slug])
            ->with('success', __('Товар был успешно обновлен'));
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->imageSaver->remove($product, 'product');
        $product->delete();

        return redirect()
            ->route('admin.category.index')
            ->with('success', __('Товар каталога успешно удален'));
    }

    public function category(Category $category): View
    {
        $products = Product::categoryProducts($category->id)->paginate(5);
        return view('admin.product.category', compact('category', 'products'));
    }
}
