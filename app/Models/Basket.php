<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Basket extends Model
{
    use HasFactory;

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function increase($id, $count = 1)
    {
        $this->change($id, $count);
    }

    public function decrease($id, $count = 1)
    {
        $this->change($id, -1 * $count);
    }

    private function change($id, $count = 0) {
        if ($count == 0) {
            return;
        }
        // если товар есть в корзине — изменяем кол-во
        if ($this->products->contains($id)) {
            // получаем объект строки таблицы `basket_product`
            $pivotRow = $this->products()->where('product_id', $id)->first()->pivot;
            $quantity = $pivotRow->quantity + $count;
            if ($quantity > 0) {
                // обновляем количество товара $id в корзине
                $pivotRow->update(['quantity' => $quantity]);
            } else {
                // кол-во равно нулю — удаляем товар из корзины
                $pivotRow->delete();
            }
        } elseif ($count > 0) { // иначе — добавляем этот товар
            $this->products()->attach($id, ['quantity' => $count]);
        }
        // обновляем поле `updated_at` таблицы `baskets`
        $this->touch();
    }

    public function remove($id) {
        // удаляем товар из корзины (разрушаем связь)
        $this->products()->detach($id);
        // обновляем поле `updated_at` таблицы `baskets`
        $this->touch();
    }
}
