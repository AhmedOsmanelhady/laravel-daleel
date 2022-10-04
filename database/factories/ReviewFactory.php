<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "doctor_id" => function(){
                return Doctor::all()->Random();
            },
             "customer" => $this->faker->name(),
             "review" => $this->faker->paragraph(),
             "star" => $this->faker->numberBetween(0,5),
        ];
    }
}
