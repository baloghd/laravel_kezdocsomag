<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_id" => $this->faker->numberBetween(2, 5),
            "movie_id" => $this->faker->numberBetween(1, 10),
            "rating" => $this->faker->numberBetween(1, 5),
            "comment" => $this->faker->sentence(3)
        ];
    }
}
