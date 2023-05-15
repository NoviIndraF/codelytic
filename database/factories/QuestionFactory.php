<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
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
            'content' => $this->faker->paragraph(mt_rand(1, 2)),
            'note' => $this->faker->paragraph(mt_rand(1, 2)),
            'answer_correct' => $this->faker->word(mt_rand(1, 2)),
            'quiz_id' => rand(1, 3),
        ];
    }
}
