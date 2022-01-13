<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarMarqueFactory extends Factory
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
            'libelle' => $faker->vehicleBrand,
            'description' => $this->faker->text(),
        ];
    }
}
