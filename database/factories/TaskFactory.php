<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
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
            'note' => $this->faker->paragraph(mt_rand(1, 2)),
            'deadline' => $this->faker->date(),
            'status' => rand(1, 3),// password
            'room_id' => rand(1, 3),
        ];
    }
}
