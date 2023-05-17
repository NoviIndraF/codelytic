<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuizFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'slug' => $this->faker->slug(),
            'title' => $this->faker->title(),
            'description' => $this->faker->paragraph(mt_rand(1, 2)),
            'status' => rand(1, 2),// password
            'room_id' => rand(1, 3),
        ];
    }
}
