<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->numerify("movie-###"),
            'director' => $this->faker->name(),
            "description" => $this->faker->sentence(),
            "year" => $this->faker->year(),
            "length" => $this->faker->numberBetween(90, 200)
        ];
    }
}
