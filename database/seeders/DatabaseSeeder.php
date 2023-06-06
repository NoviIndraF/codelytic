<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\User;
use App\Models\Materi;
use App\Models\Chapter;
use App\Models\Student;
use App\Models\StudentRoom;
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
        StudentRoom::factory(5)->create();
    }
}
