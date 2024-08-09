<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\StoreRequest;
use App\Http\Requests\Admin\Order\UpdateRequest;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('status', 'asc')->with('user')->paginate(5);
        $statuses = Order::STATUSES;
        return view('admin.order.index',compact('orders', 'statuses'));
    }

    public function create()
    {
        $statuses = Order::STATUSES;
        return view('admin.order.create', compact('statuses'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $order = Order::create($data);

        return redirect()
            ->route('admin.order.show', ['order' => $order->id])
            ->with('success', 'Заказ был успешно создан');
    }

    public function show(Order $order)
    {
        $statuses = Order::STATUSES;
        return view('admin.order.show', compact('order', 'statuses'));
    }

    public function edit(Order $order)
    {
        $statuses = Order::STATUSES;
        return view('admin.order.edit', compact('order', 'statuses'));
    }

    public function update(UpdateRequest $request, Order $order)
    {
        $data = $request->validated();
        $order->update($data);

        return redirect()
            ->route('admin.order.show', ['order' => $order->id])
            ->with('success', 'Заказ был успешно обновлен');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()
            ->route('admin.order.index')
            ->with('success', 'Заказ успешно удален');
    }
}
