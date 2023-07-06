<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\Discussion;
use App\Models\Group;
use App\Models\Materi;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Room;
use App\Models\Student;
use App\Models\StudentGroupComment;
use App\Models\StudentGroup;
use App\Models\StudentQuiz;
use App\Models\StudentRoom;
use App\Models\StudentTask;
use App\Models\Task;
use App\Models\User;
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
        Chapter::factory(10)->create();
        Discussion::factory(10)->create();
        Group::factory(5)->create();
        Materi::factory(5)->create();
        Quiz::factory(10)->create();
        Question::factory(20)->create();
        Room::factory(3)->create();
        Student::factory(6)->create();
        StudentGroupComment::factory(5)->create();
        StudentGroup::factory(5)->create();
        StudentQuiz::factory(5)->create();
        StudentRoom::factory(5)->create();
        StudentTask::factory(5)->create();
        Task::factory(6)->create();
        User::factory(3)->create();
    }
}
