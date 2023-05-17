<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ChapterFactory extends Factory
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
            'index' => rand(1, 5),
            'title' => $this->faker->title(),
            'content' => $this->faker->paragraph(mt_rand(1, 2)),
            'description' => $this->faker->paragraph(mt_rand(1, 2)),
            'materi_id' => rand(1, 5),
        ];
    }
}
