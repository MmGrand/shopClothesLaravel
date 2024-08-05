<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
//Маршруты для страниц
Route::get('page/{page}', PageController::class)->name('page.show');

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
Route::post('/basket/saveorder', [BasketController::class, 'saveOrder'])->name('basket.saveorder');
Route::get('/basket/success', [BasketController::class, 'success'])->name('basket.success');
Route::post('/basket/profile', [BasketController::class, 'profile'])->name('basket.profile');


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
});

//Маршруты для админ-панели
Route::group([
	'as' => 'admin.',
	'prefix' => 'admin',
	'middleware' => ['auth', 'admin']
], function () {
	Route::get('/', AdminController::class)->name('index');
	//crud category
	Route::resource('category', CategoryController::class);
	//crud brand
	Route::resource('brand', BrandController::class);
    //crud product
	Route::resource('product', ProductController::class);
    // Маршрут для просмотра товаров категории
    Route::get('product/category/{category}', [ProductController::class, 'category'])->name('product.category');
    // Маршруты для просмотра и редактирования заказов
    Route::resource('order', OrderController::class)->except([
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
