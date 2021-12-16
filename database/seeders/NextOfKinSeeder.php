<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NextOfKinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\NextOfKin::factory(30)->create();
    }
}
