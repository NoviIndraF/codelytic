<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DiscussionFactory extends Factory
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
            'content' => $this->faker->paragraph(mt_rand(1, 2)),
            'description' => $this->faker->paragraph(mt_rand(1, 2)),
            'status' => rand(0, 1),// password
            'room_id' => rand(1, 3),
        ];
    }
}
