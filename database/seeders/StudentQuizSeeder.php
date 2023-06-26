<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StudentQuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\StudentQuiz::factory(5)->create();
    }
}
