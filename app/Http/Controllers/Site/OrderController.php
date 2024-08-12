<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::whereUserId(auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        $statuses = Order::STATUSES;

        $breadcrumbs = [
            ['title' => __('Главная'), 'href' => route('home')],
            ['title' => __('Личный кабинет'), 'href' => route('user.index')],
            ['title' => __('Заказы')]
        ];

        return view('site.user.order.index', compact('orders', 'statuses', 'breadcrumbs'));
    }

    public function show(Order $order): View
    {
        if (auth()->user()->id !== $order->user_id) {
            abort(404);
        }
        $statuses = Order::STATUSES;

        $breadcrumbs = [
            ['title' => __('Главная'), 'href' => route('home')],
            ['title' => __('Личный кабинет'), 'href' => route('user.index')],
            ['title' => __('Заказы'), 'href' => route('user.order.index')],
            ['title' => __('Просмотр заказа') . " №" . $order->id]
        ];

        return view('site.user.order.show', compact('order', 'statuses', 'breadcrumbs'));
    }
}
