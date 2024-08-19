<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\Site\BasketController;
use App\Http\Controllers\Site\CatalogController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\OrderController;
use App\Http\Controllers\Site\ProfileController;
use App\Http\Controllers\Site\UserController;
use App\Http\Middleware\Localization;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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

Route::get('/localization/{locale}', LocalizationController::class)->name('localization');

Route::middleware(Localization::class)
	->group(function () {
		// Маршрут для главной страницы
		Route::get('', HomeController::class)->name('home');

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
		Route::prefix('user')->group(function () {
			Auth::routes();

			// Маршруты для подтверждения почты и повторной отправки письма
			Route::get('email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
				$request->fulfill();

				return redirect()
							->route('user.index')
							->with('success', __('Ваш email успешно подтвержден!'));
			})->middleware(['auth', 'signed'])->name('verification.verify');

			Route::post('email/verification-notification', function (Request $request) {
				$request->user()->sendEmailVerificationNotification();
				return back()->with('success', __('Ссылка подтверждения отправлена!'));
			})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
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
			// crud orders
			Route::resource('order', AdminOrderController::class);
			// crud users
			Route::resource('user', AdminUserController::class);
		});

		Route::fallback(function(){
			return view('errors.404');
		});
	});
