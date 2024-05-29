<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('password')
        ]);
        $superadmin->syncRoles(['Superadmin']);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password')
        ]);
        $admin->syncRoles(['Admin']);

        for ($i=1; $i <= 100; $i++) { 
            $user = User::create([
                'name' => 'User',
                'email' => "user{$i}@gmail.com",
                'password' => Hash::make('password')
            ]);
            $user->syncRoles(['User']);
        }

        for ($i=1; $i <= 100; $i++) { 
            $inactive = User::create([
                'name' => 'Inactive',
                'email' => "inactive{$i}@gmail.com",
                'password' => Hash::make('password')
            ]);
            $inactive->syncRoles(['Inactive']);
        }
    }
}
