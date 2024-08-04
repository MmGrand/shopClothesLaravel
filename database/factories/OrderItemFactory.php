<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::inRandomOrder()->first();
        $quantity = rand(1, 5);
        return [
            'order_id' => Order::inRandomOrder()->first()->id,
            'product_id' => $product->id,
            'name' => fake()->sentence,
            'price' => $product->price,
            'quantity' => $quantity,
            'cost' => $product->price * $quantity
        ];
    }
}
