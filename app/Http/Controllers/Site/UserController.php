<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('site.user.index');
    }
}
