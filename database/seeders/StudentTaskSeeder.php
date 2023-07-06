<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StudentTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\StudentTask::factory(5)->create();
    }
}
