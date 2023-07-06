<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DiscussionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Discussion::factory(3)->create();
    }
}
