<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => Str::random(6),
            'slug' => $this->faker->slug(),
            'name' => $this->faker->city(),
            'major' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(mt_rand(1,2)),// password
            'user_id' => rand(1, 3),
        ];
    }
}
