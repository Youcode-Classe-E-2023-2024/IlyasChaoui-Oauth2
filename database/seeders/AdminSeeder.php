<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create an admin role if it doesn't exist
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Create the admin user and associate the admin role
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'ilyas@gmail.com',
            'password' => bcrypt('ilyas@gmail.com'),
            'role_id' => $adminRole->id,
        ]);
    }
}
