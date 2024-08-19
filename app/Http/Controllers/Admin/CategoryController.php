<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CategoryCatalogRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    private $imageSaver;

    public function __construct(ImageSaver $imageSaver)
    {
        $this->imageSaver = $imageSaver;
    }

    public function index(): View
    {
        $items = Category::all();
        return view('admin.category.index', compact('items'));
    }

    public function create(): View
    {
        $items = Category::all();
        return view('admin.category.create', compact('items'));
    }

    public function store(CategoryCatalogRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['image'] = $this->imageSaver->upload($request, null, 'category');

        $category = Category::create($data);

        return redirect()
            ->route('admin.category.show', ['category' => $category->slug])
            ->with('success', __('Новая категория успешно создана'));
    }

    public function show(Category $category): View
    {
        return view('admin.category.show', compact('category'));
    }

    public function edit(Category $category): View
    {
        $items = Category::all();
        return view('admin.category.edit', compact('category', 'items'));
    }

    public function update(CategoryCatalogRequest $request, Category $category): RedirectResponse
    {
        $data = $request->validated;
        $data['image'] = $this->imageSaver->upload($request, $category, 'category');

        $category->update($data);

        return redirect()
            ->route('admin.category.show', ['category' => $category->slug])
            ->with('success', __('Категория успешно обновлена'));
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->children->count()) {
            $errors[] = 'Нельзя удалить категорию с дочерними категориями';
        }

        if ($category->products->count()) {
            $errors[] = 'Нельзя удалить категорию, которая содержит товары';
        }

        if (!empty($errors)) {
            return back()->withErrors($errors);
        }

        $this->imageSaver->remove($category, 'category');
        $category->delete();

        return redirect()
            ->route('admin.category.index')
            ->with('success', __('Категория каталога успешно удалена'));
    }
}
