<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'student_id' => rand(1, 3),
            'group_id' => rand(1, 3),
            'room_id' => rand(1, 3),
        ];
    }
}
