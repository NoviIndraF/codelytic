<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StudentGroupCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\StudentGroupComment::factory(2)->create();
    }
}
