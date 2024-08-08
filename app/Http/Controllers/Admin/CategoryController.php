<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryCatalogRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    private $imageSaver;

    public function __construct(ImageSaver $imageSaver)
    {
        $this->imageSaver = $imageSaver;
    }

    public function index()
    {
        $items = Category::all();
        return view('admin.category.index', compact('items'));
    }

    public function create()
    {
        $items = Category::all();
        return view('admin.category.create', compact('items'));
    }

    public function store(CategoryCatalogRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $this->imageSaver->upload($request, null, 'category');

        $category = Category::create($data);

        return redirect()
            ->route('admin.category.show', ['category' => $category->slug])
            ->with('success', 'Новая категория успешно создана');
    }

    public function show(Category $category)
    {
        return view('admin.category.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $items = Category::all();
        return view('admin.category.edit', compact('category', 'items'));
    }

    public function update(CategoryCatalogRequest $request, Category $category)
    {
        $data = $request->validated;
        $data['image'] = $this->imageSaver->upload($request, $category, 'category');

        $category->update($data);

        return redirect()
            ->route('admin.category.show', ['category' => $category->slug])
            ->with('success', 'Категория успешно обновлена');
    }

    public function destroy(Category $category)
    {
        if ($category->children->count())
        {
            $errors[] = 'Нельзя удалить категорию с дочерними категориями';
        }

        if ($category->products->count())
        {
            $errors[] = 'Нельзя удалить категорию, которая содержит товары';
        }

        if (!empty($errors))
        {
            return back()->withErrors($errors);
        }

        $this->imageSaver->remove($category, 'category');
        $category->delete();

        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Категория каталога успешно удалена');
    }
}
