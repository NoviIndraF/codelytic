<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StudentGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\StudentGroup::factory(2)->create();
    }
}
