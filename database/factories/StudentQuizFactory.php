<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentQuizFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'score' => rand(50, 100),
            'student_id' => rand(1, 3),
            'sended' => $this->faker->date('now'),
            'quiz_id' => rand(1, 3),
            'room_id' => rand(1, 3),
        ];
    }
}
