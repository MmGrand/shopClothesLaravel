<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\Order\OrderRequest;
use App\Models\Basket;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BasketController extends Controller
{
    private $basket;

    public function __construct()
    {
        $this->basket = Basket::getBasket();
    }

    public function index(): View
    {
        $products = $this->basket->products;

        $breadcrumbs = [
            ['title' => __('Главная'), 'href' => route('home')],
            ['title' => __('Корзина')],
        ];

        return view('site.basket.index', compact('products', 'breadcrumbs'));
    }

    public function checkout(Request $request): View
    {
        $profile = null;
        $profiles = null;
        if (auth()->check()) {
            $user = auth()->user();
            $profiles = $user->profiles;
            $prof_id = (int)$request->input('profile_id');
            if ($prof_id) {
                $profile = $user->profiles()->whereIdAndUserId($prof_id, $user->id)->first();
            }
        }

        $breadcrumbs = [
            ['title' => __('Главная'), 'href' => route('home')],
            ['title' => __('Корзина'), 'href' => route('basket.index')],
            ['title' => __('Оформление заказа')],
        ];

        return view('site.basket.checkout', compact('profiles', 'profile', 'breadcrumbs'));
    }

    public function add(Request $request, $id): View
    {
        $quantity = $request->input('quantity') ?? 1;
        $this->basket->increase($id, $quantity);
        if (! $request->ajax()) {
            return back();
        }

        $positions = $this->basket->products()->count();
        return view('site.basket.partials.basket', compact('positions'));
    }

    public function plus($id): RedirectResponse
    {
        $this->basket->increase($id);
        return redirect()->route('basket.index');
    }

    public function minus($id): RedirectResponse
    {
        $this->basket->decrease($id);
        return redirect()->route('basket.index');
    }

    public function remove($id): RedirectResponse
    {
        $this->basket->remove($id);
        return redirect()->route('basket.index');
    }

    public function clear(): RedirectResponse
    {
        $this->basket->delete();
        return redirect()->route('basket.index');
    }

    public function saveOrder(OrderRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $basket = Basket::getBasket();
        $user_id = auth()->check() ? auth()->user()->id : null;

        $order = Order::create(
            $data + [
                'amount' => $basket->getAmount(),
                'user_id' => $user_id,
                'status' => 0
            ]
        );

        foreach ($basket->products as $product) {
            $order->items()->create([
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $product->pivot->quantity,
                'cost' => $product->price * $product->pivot->quantity
            ]);
        }

        $basket->delete();

        return redirect()->route('basket.success')->with('order_id', $order->id);
    }

    public function success(Request $request): View|RedirectResponse
    {
        if ($request->session()->exists('order_id')) {
            $order_id = $request->session()->pull('order_id');
            $order = Order::findOrFail($order_id);

            $breadcrumbs = [
                ['title' => __('Главная'), 'href' => route('home')],
                ['title' => __('Корзина'), 'href' => route('basket.index')],
                ['title' => __('Сформированный заказ')],
            ];

            return view('site.basket.success', compact('order', 'breadcrumbs'));
        } else {
            return redirect()->route('basket.index');
        }
    }

    public function profile(Request $request): JsonResponse
    {
        if (! $request->ajax()) {
            abort(404);
        }
        if (! auth()->check()) {
            return response()->json(['error' => 'Нужна авторизация!'], 404);
        }
        $user = auth()->user();
        $profile_id = (int)$request->input('profile_id');

        if ($profile_id) {
            $profile = $user->profiles()->whereIdAndUserId($profile_id, $user->id)->first();
            if ($profile) {
                return response()->json(['profile' => $profile]);
            }
        }
        return response()->json(['error' => 'Профиль не найден!'], 404);
    }
}
