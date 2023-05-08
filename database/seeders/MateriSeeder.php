<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Materi::factory(3)->create();
    }
}
