<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {

        $breadcrumbs = [
            ['title' => __('Главная'), 'href' => route('home')],
            ['title' => __('Личный кабинет')]
        ];

        return view('site.user.index', compact('breadcrumbs'));
    }
}
