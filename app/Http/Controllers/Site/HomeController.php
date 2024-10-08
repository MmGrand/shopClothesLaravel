<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $new = Product::whereIsPublished(true)->whereNew(true)->latest()->limit(3)->get();
        $hit = Product::whereIsPublished(true)->whereHit(true)->latest()->limit(3)->get();
        $sale = Product::whereIsPublished(true)->whereSale(true)->latest()->limit(3)->get();

        return view('site.home.index', compact('new', 'hit', 'sale'));
    }
}
