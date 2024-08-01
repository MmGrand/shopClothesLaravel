<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Маршруты для главной страницы
Route::get('/', HomeController::class)->name('home');

// Маршруты для страницы каталога
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/category/{category}', [CatalogController::class, 'category'])->name('catalog.category');
Route::get('/catalog/brand/{brand}', [CatalogController::class, 'brand'])->name('catalog.brand');
Route::get('/catalog/product/{product}', [CatalogController::class, 'product'])->name('catalog.product');

// Маршруты для корзины
Route::get('/basket/index', [BasketController::class, 'index'])->name('basket.index');
Route::get('/basket/checkout', [BasketController::class, 'checkout'])->name('basket.checkout');
Route::post('/basket/add/{id}', [BasketController::class, 'add'])
	->where('id', '[0-9]+')
	->name('basket.add');
Route::post('/basket/plus/{id}', [BasketController::class, 'plus'])
	->where('id', '[0-9]+')
	->name('basket.plus');
Route::post('/basket/minus/{id}', [BasketController::class, 'minus'])
	->where('id', '[0-9]+')
	->name('basket.minus');
Route::post('/basket/remove/{id}', [BasketController::class, 'remove'])
	->where('id', '[0-9]+')
	->name('basket.remove');
Route::post('/basket/clear', [BasketController::class, 'clear'])->name('basket.clear');

Route::name('user.')->prefix('user')->group(function () {
	Auth::routes();
});
