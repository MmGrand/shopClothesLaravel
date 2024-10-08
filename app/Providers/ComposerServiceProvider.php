<?php

namespace App\Providers;

use App\Models\Basket;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('layouts.partials.categories', function($view) {
            $view->with(['items' => Category::all()]);
        });
        View::composer('layouts.partials.brands', function($view) {
            $view->with(['brands' => Brand::popular()]);
        });
        View::composer('layouts.main', function($view) {
            $view->with(['positions' => Basket::getCount()]);
        });
    }
}
