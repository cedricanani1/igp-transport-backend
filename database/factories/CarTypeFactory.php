<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarTypeFactory extends Factory
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
            'libelle' => $faker->vehicleType,
            'parent_id' => 0,
            'description' => $this->faker->text(),
        ];
    }
}
