<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $new = Product::whereNew(true)->latest()->limit(3)->get();
        $hit = Product::whereHit(true)->latest()->limit(3)->get();
        $sale = Product::whereSale(true)->latest()->limit(3)->get();
        return view('home', compact('new', 'hit', 'sale'));
    }
}
