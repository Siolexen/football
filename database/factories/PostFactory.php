<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid(),
            'slug' => $this->faker->word(),
            'title' => $this->faker->word(),
            'body' => $this->faker->sentence(),
            'user_id' => 1,
        ];
    }
}
