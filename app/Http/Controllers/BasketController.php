<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class BasketController extends Controller
{
    private $basket;

    public function __construct()
    {
        $this->getBasket();
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

    private function getBasket() {
        $basket_id = request()->cookie('basket_id');
        if (!empty($basket_id)) {
            try {
                $this->basket = Basket::findOrFail($basket_id);
            } catch (ModelNotFoundException $e) {
                $this->basket = Basket::create();
            }
        } else {
            $this->basket = Basket::create();
        }
        Cookie::queue('basket_id', $this->basket->id, 525600);
    }
}
