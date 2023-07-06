<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentGroupCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'message' => $this->faker->paragraph(mt_rand(0, 1)),
            'like' => rand(0, 2),
            'hide' => rand(0, 1),
            'student_id' => rand(1, 3),
            'group_id' => rand(1, 3),
            'user_id' => rand(1, 3),
        ];
    }
}
