<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::whereUserId(auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        $statuses = Order::STATUSES;
        return view('site.user.order.index', compact('orders', 'statuses'));
    }

    public function show(Order $order)
    {
        if (auth()->user()->id !== $order->user_id)
        {
            abort(404);
        }
        $statuses = Order::STATUSES;
        return view('site.user.order.show', compact('order', 'statuses'));
    }
}
