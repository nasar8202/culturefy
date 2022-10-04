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
<<<<<<< HEAD
            'role_permission' => 'all',
=======
            'role_permission' => array('all'),
>>>>>>> 25f024b58ccbd64e720a8f87c28177720ec437f9
            'role_name' => 'admin',

        ]);
        User::create([
            'full_name' => 'Super Admin',
            'role_id'=>1,
            'email' => 'superadmin@gmail.com',
            'password' => hash::make('12345678'),
        ]);
<<<<<<< HEAD
=======



>>>>>>> 25f024b58ccbd64e720a8f87c28177720ec437f9
    }
}
