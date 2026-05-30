<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,      // Roles + Admin User
            CategorySeeder::class,  // Categories الأول
            ProductSeeder::class,   // Products بعدها
        ]);
    }
}