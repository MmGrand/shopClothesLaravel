<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandCatalogRequest;
use App\Models\Brand;

class BrandController extends Controller
{
    private $imageSaver;

    public function __construct(ImageSaver $imageSaver) {
        $this->imageSaver = $imageSaver;
    }

    public function index()
    {
        $brands = Brand::all();
        return view('admin.brand.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function store(BrandCatalogRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $this->imageSaver->upload($request, null, 'brand');

        $brand = Brand::create($data);

        return redirect()
            ->route('admin.brand.show', ['brand' => $brand->slug])
            ->with('success', 'Новый бренд успешно создан');
    }

    public function show(Brand $brand)
    {
        return view('admin.brand.show', compact('brand'));
    }

    public function edit(Brand $brand)
    {
        return view('admin.brand.edit',compact('brand'));
    }

    public function update(BrandCatalogRequest $request, Brand $brand)
    {
        $data = $request->validated();
        $data['image'] = $this->imageSaver->upload($request, $brand, 'brand');

        $brand->update($data);

        return redirect()
            ->route('admin.brand.show', ['brand' => $brand->slug])
            ->with('success', 'Бренд был успешно отредактирован');
    }

    public function destroy(Brand $brand)
    {
        if ($brand->products->count()) {
            return back()->withErrors('Нельзя удалить бренд, у которого есть товары');
        }

        $this->imageSaver->remove($brand, 'brand');
        $brand->delete();

        return redirect()
            ->route('admin.brand.index')
            ->with('success', 'Бренд каталога успешно удален');
    }
}
