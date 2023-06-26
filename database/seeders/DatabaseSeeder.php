<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\User;
use App\Models\Materi;
use App\Models\Chapter;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Student;
use App\Models\StudentQuiz;
use App\Models\StudentRoom;
use App\Models\StudentTask;
use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(3)->create();
        Materi::factory(5)->create();
        Chapter::factory(10)->create();
        Room::factory(3)->create();
        Student::factory(6)->create();
        StudentQuiz::factory(5)->create();
        StudentRoom::factory(5)->create();
        StudentTask::factory(5)->create();
        Quiz::factory(10)->create();
        Question::factory(20)->create();
        Task::factory(6)->create();
    }
}
