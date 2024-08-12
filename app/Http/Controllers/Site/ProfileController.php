<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\Profile\StoreRequest;
use App\Http\Requests\Site\Profile\UpdateRequest;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        $breadcrumbs = [
            ['title' => __('Главная'), 'href' => route('home')],
            ['title' => __('Личный кабинет'), 'href' => route('user.index')],
            ['title' => __('Профили')]
        ];

        $profiles = auth()->user()->profiles()->paginate(4);
        return view('site.user.profile.index', compact('profiles', 'breadcrumbs'));
    }

    public function create(): View
    {
        $breadcrumbs = [
            ['title' => __('Главная'), 'href' => route('home')],
            ['title' => __('Личный кабинет'), 'href' => route('user.index')],
            ['title' => __('Профили'), 'href' => route('user.profile.index')],
            ['title' => __('Создание профиля')]
        ];

        return view('site.user.profile.create', compact('breadcrumbs'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $profile = Profile::create($data);
        return redirect()
            ->route('user.profile.show', ['profile' => $profile->id])
            ->with('success', 'Новый профиль успешно создан');
    }

    public function show(Profile $profile): View
    {
        if ($profile->user_id !== auth()->user()->id) {
            abort(404);
        }

        $breadcrumbs = [
            ['title' => __('Главная'), 'href' => route('home')],
            ['title' => __('Личный кабинет'), 'href' => route('user.index')],
            ['title' => __('Профили'), 'href' => route('user.profile.index')],
            ['title' => $profile->title]
        ];

        return view('site.user.profile.show', compact('profile', 'breadcrumbs'));
    }

    public function edit(Profile $profile): View
    {
        if ($profile->user_id !== auth()->user()->id) {
            abort(404);
        }

        $breadcrumbs = [
            ['title' => __('Главная'), 'href' => route('home')],
            ['title' => __('Личный кабинет'), 'href' => route('user.index')],
            ['title' => __('Профили'), 'href' => route('user.profile.index')],
            ['title' => __('Редактирование профиля')]
        ];

        return view('site.user.profile.edit', compact('profile', 'breadcrumbs'));
    }

    public function update(UpdateRequest $request, Profile $profile): RedirectResponse
    {
        $data = $request->validated();

        $profile->update($data);
        return redirect()
            ->route('user.profile.show', ['profile' => $profile->id])
            ->with('success', 'Профиль был успешно отредактирован');
    }

    public function destroy(Profile $profile): RedirectResponse
    {
        if ($profile->user_id !== auth()->user()->id) {
            abort(404);
        }
        $profile->delete();
        return redirect()
            ->route('user.profile.index')
            ->with('success', 'Профиль был успешно удален');
    }
}
