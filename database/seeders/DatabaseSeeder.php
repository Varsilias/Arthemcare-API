<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\PatientSeeder;
use Database\Seeders\NextOfKinSeeder;
use Database\Seeders\AppointmentSeeder;
use Database\Seeders\HealthRecordSeeder;
use Database\Seeders\PrescriptionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            PatientSeeder::class,
            NextOfKinSeeder::class,
            HealthRecordSeeder::class,
            PrescriptionSeeder::class,
            AppointmentSeeder::class
        ]);
    }
}
