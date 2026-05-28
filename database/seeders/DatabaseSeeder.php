<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // This is the main seeder. 
        // To run all seeders at once, list them here:
        $this->call(ProductSeeder::class);
        $this->call([
            CategorySeeder::class,
        ]);
    }
}