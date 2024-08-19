<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\StoreRequest;
use App\Http\Requests\Admin\Order\UpdateRequest;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::orderBy('status', 'asc')->with('user')->paginate(5);
        $statuses = Order::STATUSES;
        return view('admin.order.index', compact('orders', 'statuses'));
    }

    public function create(): View
    {
        $statuses = Order::STATUSES;
        return view('admin.order.create', compact('statuses'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $order = Order::create($data);

        return redirect()
            ->route('admin.order.show', ['order' => $order->id])
            ->with('success', __('Заказ был успешно создан'));
    }

    public function show(Order $order): View
    {
        $statuses = Order::STATUSES;
        return view('admin.order.show', compact('order', 'statuses'));
    }

    public function edit(Order $order): View
    {
        $statuses = Order::STATUSES;
        return view('admin.order.edit', compact('order', 'statuses'));
    }

    public function update(UpdateRequest $request, Order $order): RedirectResponse
    {
        $data = $request->validated();
        $order->update($data);

        return redirect()
            ->route('admin.order.show', ['order' => $order->id])
            ->with('success', __('Заказ был успешно обновлен'));
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();
        return redirect()
            ->route('admin.order.index')
            ->with('success', __('Заказ успешно удален'));
    }
}
