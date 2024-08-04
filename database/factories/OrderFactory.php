<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'name' => fake()->sentence,
            'email' => fake()->email,
            'phone' => fake()->phoneNumber,
            'address' => fake()->address,
            'comment' => fake()->realText(200),
            'amount' => rand(1000, 2000),
            'status' => array_rand(Order::STATUSES),
        ];
    }
}
