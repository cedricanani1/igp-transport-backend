<?php

namespace Database\Factories;

use App\Models\CarModel;
use App\Models\CarType;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
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
            'libelle' => $faker->vehicle(),
            'description' => $this->faker->text(),
            'slug' => $faker->vehicle(),
            'photo' => $this->faker->image(public_path('Car'), 640,480,'IGP',false,true).';'.$this->faker->image(public_path('Car'), 640,480,'IGP',false,true).';'.$this->faker->image(public_path('Car'), 640,480,'IGP',false,true),
            'stock' => $this->faker->randomDigit(),
            'price' => $this->faker->randomDigit(),
            'discount' => $this->faker->randomDigit(),
            'mileage' => '360km/h',
            'fuel_type' => $this->faker->randomElement(['super','gasoil']),
            'color_exterior' => 'Bleu',
            'color_interior' => 'Gris',
            'year' => $this->faker->biasedNumberBetween(1998,2020, 'sqrt'),
            'transmission' => $this->faker->randomElement(['automatique','manuel']),
            'car_type_id' =>CarType::all()->random()->id,
            'car_model_id' =>CarModel::all()->random()->id,
        ];
    }
}
