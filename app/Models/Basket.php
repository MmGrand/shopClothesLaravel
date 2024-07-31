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

    private function change($id, $count = 0)
    {
        if ($count == 0)
        {
            return;
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

    public function remove($id) {
        $this->products()->detach($id);
        $this->touch();
    }
}
