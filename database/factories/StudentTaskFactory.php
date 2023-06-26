<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StudentTaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'answer' => $this->faker->paragraph(mt_rand(1, 2)),
            'student_id' => rand(1, 3),
            'sended' => $this->faker->date('now'),
            'task_id' => rand(1, 3),
            'room_id' => rand(1, 3),
        ];
    }
}
