<?php

namespace Database\Seeders;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'role_permission' => array('all'),
            'role_name' => 'Super Admin',
            'status'=>0,

        ]);
        User::create([
            'full_name' => 'Super Admin',
            'role_id'=>1,
            'email' => 'superadmin@gmail.com',
            'password' => hash::make('12345678'),
        ]);



    }
}
