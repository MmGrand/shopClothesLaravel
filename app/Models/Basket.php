<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Cookie;

class Basket extends Model
{
    use HasFactory;

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function increase($id, $count = 1): void
    {
        $this->change($id, $count);
    }

    public function decrease($id, $count = 1): void
    {
        $this->change($id, -1 * $count);
    }

    private function change($id, $count = 0)
    {
        if ($count == 0)
        {
            return false;
        }

        if ($this->products->contains($id))
        {
            $pivotRow = $this->products()->where('product_id', $id)->first()->pivot;
            $quantity = $pivotRow->quantity + $count;
            if ($quantity > 0)
            {
                $pivotRow->update(['quantity' => $quantity]);
            }
            else
            {
                $pivotRow->delete();
            }
        } elseif ($count > 0)
        {
            $this->products()->attach($id, ['quantity' => $count]);
        }
        $this->touch();
    }

    public function remove($id): void
    {
        $this->products()->detach($id);
        $this->touch();
    }

    public static function getBasket(): Basket
    {
        $basket_id = request()->cookie('basket_id');
        if (!empty($basket_id))
        {
            try {
                $basket = Basket::findOrFail($basket_id);
            } catch (ModelNotFoundException $e) {
                $basket = Basket::create();
            }
        }
        else
        {
            $basket = Basket::create();
        }
        Cookie::queue('basket_id', $basket->id, 525600);

        return $basket;
    }

    public static function getCount(): int
    {
        $basket_id = request()->cookie('basket_id');
        if(empty($basket_id))
        {
            return 0;
        }
        return self::getBasket()->products->count();
    }

    public function getAmount(): float
    {
        $amount = 0.0;
        foreach($this->products as $product)
        {
            $amount += $product->price * $product->pivot->quantity;
        }

        return $amount;
    }
}
