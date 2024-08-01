<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Order;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class BasketController extends Controller
{
    private $basket;

    public function __construct()
    {
        $this->basket = Basket::getBasket();
    }

    public function index()
    {
        $products = $this->basket->products;

        return view('basket.index', compact('products'));
    }

    public function checkout()
    {
        return view('basket.checkout');
    }

    public function add(Request $request, $id)
    {
        $quantity = $request->input('quantity') ?? 1;
        $this->basket->increase($id, $quantity);

        return back();
    }

    public function plus($id)
    {
        $this->basket->increase($id);
        return redirect()->route('basket.index');
    }

    public function minus($id)
    {
        $this->basket->decrease($id);
        return redirect()->route('basket.index');
    }

    public function remove($id)
    {
        $this->basket->remove($id);
        return redirect()->route('basket.index');
    }

    public function clear()
    {
        $this->basket->delete();
        return redirect()->route('basket.index');
    }

    public function saveOrder(Request $request)
    {
        $validated = $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'comment' => 'nullable|string|max:255'
        ]);

        $basket = Basket::getBasket();
        $user_id = auth()->check() ? auth()->user()->id : null;
        $order = Order::create($validated + ['amount' => $basket->getAmount(), 'user_id' => $user_id]);

        foreach($basket->products as $product)
        {
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

    public function success(Request $request)
    {
        if ($request->session()->exists('order_id'))
        {
            $order_id = $request->session()->pull('order_id');
            $order = Order::findOrFail($order_id);
            return view('basket.success', compact('order'));
        }
        else
        {
            return redirect()->route('basket.index');
        }
    }
}
