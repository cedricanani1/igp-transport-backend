<?php

namespace Database\Factories;

use App\Models\CarMarque;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = (new \Faker\Factory())::create();
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));
        return [
            'libelle' => $faker->vehicleModel,
            'description' => $this->faker->text(),
            'car_marque_id' =>CarMarque::all()->random()->id,
        ];
    }
}
