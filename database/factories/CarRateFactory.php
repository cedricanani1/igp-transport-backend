<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarRateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rate' => $this->faker->randomElement([1,2,3,4,5]),
            'user_id' => 1,
            'message' => $this->faker->text(),
            'product_id' => Car::all()->random()->id,
        ];
    }
}
