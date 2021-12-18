<?php

namespace Database\Seeders;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctor = Role::create(['name' => 'Doctor']);
        Role::create(['name' => 'Nurse']);
        Role::create(['name' => 'FrontDesk Staff']);

        $daniel = \App\Models\User::create([
            'firstname' => "Daniel",
            'lastname' => "Okoronkwo",
            'gender' => "male",
            'DOB' => "02-09-2001",
            'username' => "Varsilias",
            'speciality' => "Gynaecology",
            'email' => "danielokoronkwo90@gmail.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $daniel->assignRole($doctor);

        foreach(Role::all() as $role) {
            $users = \App\Models\User::factory(10)->create();
            foreach($users as $user){
                $user->assignRole($role);
            }
        }


    }
}
