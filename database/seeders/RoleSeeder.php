<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $adminRole = Role::create([
            'name'        => 'admin',
            'description' => 'Administrator role',
        ]);

        $userRole = Role::create([
            'name'        => 'user',
            'description' => 'Regular user role',
        ]);

        // Create first admin user
        $admin = User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@fashionstore.com',
            'password' => Hash::make('password123'),
        ]);

        // Assign admin role to admin user
        $admin->roles()->attach($adminRole->id);
    }
}