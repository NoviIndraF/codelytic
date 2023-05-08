<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MateriFactory extends Factory
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
            'title' => $this->faker->country(),
            'created' => $this->faker->date(),
            'description' => $this->faker->paragraph(mt_rand(null, 1)),
            'status' => rand(1, 3),// password
            'room_id' => rand(1, 3),
        ];
    }
}
