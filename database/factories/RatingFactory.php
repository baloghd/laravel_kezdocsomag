<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;

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
            "user_id" => $this->faker->numberBetween(2, 50),
            "movie_id" => $this->faker->numberBetween(1, 50),
            "rating" => $this->faker->numberBetween(1, 5),
            "comment" => $this->faker->sentences($this->faker->numberBetween(1, 5), true)
        ];
    }
}
