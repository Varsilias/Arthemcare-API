<?php

namespace Database\Seeders;

use Illuminate\Support\Arr;
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
        Role::create(['name' => 'Doctor']);
        Role::create(['name' => 'Nurse']);
        Role::create(['name' => 'FrontDesk Staff']);

        // $user = \App\Models\User::factory(10)->create();

        foreach(Role::all() as $role) {
            $users = \App\Models\User::factory(10)->create();
            foreach($users as $user){
                $user->assignRole($role);
            }
        }


    }
}
