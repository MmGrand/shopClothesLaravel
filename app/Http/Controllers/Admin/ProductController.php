<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCatalogRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private $imageSaver;

    public function __construct(ImageSaver $imageSaver) {
        $this->imageSaver = $imageSaver;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roots = Category::where('parent_id', 0)->get();
        $products = Product::paginate(5);
        return view('admin.product.index', compact('products', 'roots'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Category::all();
        $brands = Brand::all();

        return view('admin.product.create', compact('items', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCatalogRequest $request)
    {
        $request->merge([
            'new' => $request->has('new'),
            'hit' => $request->has('hit'),
            'sale' => $request->has('sale'),
        ]);

        $data = $request->validated();
        $data['image'] = $this->imageSaver->upload($request, null, 'product');

        $options = [
            'new' => $request->has('new'),
            'hit' => $request->has('hit'),
            'sale' => $request->has('sale'),
            'is_published' => $request->has('is_published'),
            'views_count' => !empty($data['views_count']) ? $data['views_count'] : 0
        ];
        $data = array_merge($data, $options);

        $product = Product::create($data);

        return redirect()
            ->route('admin.product.show', ['product' => $product->slug])
            ->with('success', 'Новый товар успешно создан');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $items = Category::all();
        $brands = Brand::all();

        return view('admin.product.edit', compact('product', 'items', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductCatalogRequest $request, Product $product)
    {
        $data = $request->validated();

        $data['image'] = $this->imageSaver->upload($request, $product, 'product');

        $options = [
            'new' => $request->has('new'),
            'hit' => $request->has('hit'),
            'sale' => $request->has('sale'),
            'is_published' => $request->has('is_published'),
            'views_count' => !empty($data['views_count']) ? $data['views_count'] : 0
        ];
        $data = array_merge($data, $options);

        $product->update($data);

        return redirect()
            ->route('admin.product.show', ['product' => $product->slug])
            ->with('success', 'Товар был успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->imageSaver->remove($product, 'product');
        $product->delete();

        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Товар каталога успешно удален');
    }

    public function category(Category $category)
    {
        $products = $category->products()->paginate(5);

        return view('admin.product.category', compact('category', 'products'));
    }
}
