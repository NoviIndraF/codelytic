<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StudentRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\StudentRoom::factory(5)->create();
    }
}
