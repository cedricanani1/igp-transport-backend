<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderCarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => Order::all()->random()->id,
            'car_id' => Car::all()->random()->id,
            'quantity' => $this->faker->randomDigit() ,
            'price' => $this->faker->randomDigit(),
        ];
    }
}
