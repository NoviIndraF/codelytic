<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(3)->create();
        \App\Models\Materi::factory(5)->create();
        \App\Models\Chapter::factory(10)->create();
        \App\Models\Room::factory(3)->create();
    }
}
