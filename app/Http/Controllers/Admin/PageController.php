<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::all();
        return view('admin.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Page::where('parent_id', 0)->get();
        return view('admin.page.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|string|max:100',
            'parent_id' => 'required|integer|regex:~^[0-9]+$~',
            'slug' => 'required|string|max:100|unique:pages|regex:~^[-_a-z0-9]+$~i',
            'content' => 'required|string',
        ]);
        $page = Page::create($data);

        return redirect()
            ->route('admin.page.show', ['page' => $page->slug])
            ->with('success', 'Новая страница успешно создана');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        return view('admin.page.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        $parents = Page::where('parent_id', 0)->get();
        return view('admin.page.edit', compact('page', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $data = $this->validate($request, [
            'name' => 'required|string|max:100',
            'parent_id' => 'required|integer|regex:~^[0-9]+$~|not_in:'.$page->id,
            'slug' => 'required|string|max:100|unique:pages,slug,'.$page->id.',id|regex:~^[-_a-z0-9]+$~i',
            'content' => 'required|string',
        ]);
        $page->update($data);

        return redirect()
            ->route('admin.page.show', ['page' => $page->slug])
            ->with('success', 'Страница была успешно отредактирована');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        if ($page->children->count()) {
            return back()->withErrors('Нельзя удалить страницу, у которой есть дочерние');
        }
        $this->removeImages($page->content);
        $page->delete();
        return redirect()
            ->route('admin.page.index')
            ->with('success', 'Страница сайта успешно удалена');
    }

    public function uploadImage(Request $request) {
        $this->validate($request, ['image' => [
            'mimes:jpeg,jpg,png',
            'max:5000' // 5 Мбайт
        ]]);
        $path = $request->file('image')->store('page', 'public');
        $url = asset('storage/' . $path);
        return response()->json(['image' => $url]);
    }

    public function removeImage(Request $request) {
        $path = parse_url($request->image, PHP_URL_PATH);
        $path = str_replace('/storage/', '', $path);
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            return 'Изображение было удалено';
        }
        return 'Не удалось удалить изображение';
    }

    private function removeImages($content) {
        $dom = new \DomDocument();
        $dom->loadHtml($content);
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            $pattern = '~/storage/page/([0-9a-f]{32}\.(jpeg|png|gif))~';
            if (preg_match($pattern, $src, $match)) {
                $name = $match[1];
                if (Storage::disk('public')->exists('page/' . $name)) {
                    Storage::disk('public')->delete('page/' . $name);
                }
            }
        }
    }
}
