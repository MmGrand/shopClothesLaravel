<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

// Маршрут для главной страницы
Route::get('', HomeController::class)->name('home');
//Маршруты для страниц
Route::get('page/{page}', PageController::class)->name('page.show');

// Маршруты для страницы каталога
Route::group([
	'as' => 'catalog.',
	'prefix' => 'catalog',
], function () {
	Route::get('', [CatalogController::class, 'index'])->name('index');
	Route::get('category/{category}', [CatalogController::class, 'category'])->name('category');
	Route::get('brand/{brand}', [CatalogController::class, 'brand'])->name('brand');
	Route::get('product/{product}', [CatalogController::class, 'product'])->name('product');
	Route::get('search', [CatalogController::class, 'search'])->name('search');
});


// Маршруты для корзины
Route::group([
	'as' => 'basket.',
	'prefix' => 'basket',
], function () {
	Route::get('index', [BasketController::class, 'index'])->name('index');
	Route::get('checkout', [BasketController::class, 'checkout'])->name('checkout');
	Route::post('profile', [BasketController::class, 'profile'])->name('profile');
	Route::post('saveorder', [BasketController::class, 'saveOrder'])->name('saveorder');
	Route::get('success', [BasketController::class, 'success'])->name('success');
	Route::post('add/{id}', [BasketController::class, 'add'])
		->where('id', '[0-9]+')
		->name('add');
	Route::post('plus/{id}', [BasketController::class, 'plus'])
		->where('id', '[0-9]+')
		->name('plus');
	Route::post('minus/{id}', [BasketController::class, 'minus'])
		->where('id', '[0-9]+')
		->name('minus');
	Route::post('remove/{id}', [BasketController::class, 'remove'])
		->where('id', '[0-9]+')
		->name('remove');
	Route::post('clear', [BasketController::class, 'clear'])->name('clear');
});

// Маршруты для пользователя и функций с авторизацией
Route::name('user.')->prefix('user')->group(function () {
	Auth::routes();
});

// Маршруты для личного кабинета и профилей
Route::group([
	'as' => 'user.',
	'prefix' => 'user',
	'middleware' => ['auth']
], function () {
	// главная страница личного кабинета пользователя
	Route::get('index', [userController::class, 'index'])->name('index');
	// CRUD-операции над профилями пользователя
	Route::resource('profile', ProfileController::class);
	// просмотр списка заказов в личном кабинете
	Route::get('order', [OrderController::class, 'index'])->name('order.index');
	// просмотр отдельного заказа в личном кабинете
	Route::get('order/{order}', [OrderController::class, 'show'])->name('order.show');
});

//Маршруты для админ-панели
Route::group([
	'as' => 'admin.',
	'prefix' => 'admin',
	'middleware' => ['auth', 'admin']
], function () {
	Route::get('', AdminController::class)->name('index');
	//crud category
	Route::resource('category', CategoryController::class);
	//crud brand
	Route::resource('brand', BrandController::class);
    //crud product
	Route::resource('product', ProductController::class);
    // Маршрут для просмотра товаров категории
    Route::get('product/category/{category}', [ProductController::class, 'category'])->name('product.category');
    // Маршруты для просмотра и редактирования заказов
    Route::resource('order', AdminOrderController::class)->except([
        'create', 'store', 'destroy'
    ]);
    // Маршруты для просмотра и редактирования пользователей
    Route::resource('user', AdminUserController::class)->except([
        'create', 'store', 'show', 'destroy'
    ]);
		// crud pages
    Route::resource('page', AdminPageController::class);
		// загрузка изображения из редактора
    Route::post('page/upload/image', [AdminPageController::class, 'uploadImage'])
        ->name('page.upload.image');
    // удаление изображения в редакторе
    Route::delete('page/remove/image', [AdminPageController::class, 'removeImage'])
        ->name('page.remove.image');
});
