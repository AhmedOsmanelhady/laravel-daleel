<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name(),
            "title" => $this->faker->title(),
            "about" => $this->faker->sentence(),
            "mobile" => $this->faker->phoneNumber(),
            "phone" => $this->faker->phoneNumber(),
            "address" => $this->faker->address(),
            "city" => $this->faker->city(),
            "image" => $this->faker->imageUrl(300, 300),
        ];
    }
}
