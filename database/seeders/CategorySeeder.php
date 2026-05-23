<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Seed the categories table with hierarchical fashion categories.
     * Structure: 4 main categories with their subcategories.
     */
    public function run(): void
    {
        // ============================================
        // STEP 1: Create main (parent) categories
        // parent_id is null for root categories
        // ============================================
        $men = Category::create([
            'parent_id' => null,
            'title' => 'Men',
            'slug' => 'men',
            'description' => 'Men fashion collection',
            'status' => true,
        ]);

        $women = Category::create([
            'parent_id' => null,
            'title' => 'Women',
            'slug' => 'women',
            'description' => 'Women fashion collection',
            'status' => true,
        ]);

        $kids = Category::create([
            'parent_id' => null,
            'title' => 'Kids',
            'slug' => 'kids',
            'description' => 'Kids fashion collection',
            'status' => true,
        ]);

        $accessories = Category::create([
            'parent_id' => null,
            'title' => 'Accessories',
            'slug' => 'accessories',
            'description' => 'Fashion accessories',
            'status' => true,
        ]);

        // ============================================
        // STEP 2: Create subcategories
        // Each subcategory belongs to a parent via parent_id
        // ============================================

        // Men's subcategories
        $menSubs = ['T-Shirts', 'Shirts', 'Jeans', 'Pants', 'Jackets', 'Shoes'];
        foreach ($menSubs as $title) {
            Category::create([
                'parent_id' => $men->id,
                'title' => $title,
                'slug' => 'men-' . Str::slug($title),
                'status' => true,
            ]);
        }

        // Women's subcategories
        $womenSubs = ['Dresses', 'Tops', 'Skirts', 'Jeans', 'Bags', 'Shoes'];
        foreach ($womenSubs as $title) {
            Category::create([
                'parent_id' => $women->id,
                'title' => $title,
                'slug' => 'women-' . Str::slug($title),
                'status' => true,
            ]);
        }

        // Kids' subcategories
        $kidsSubs = ['Boys', 'Girls', 'Baby'];
        foreach ($kidsSubs as $title) {
            Category::create([
                'parent_id' => $kids->id,
                'title' => $title,
                'slug' => 'kids-' . Str::slug($title),
                'status' => true,
            ]);
        }

        // Accessories' subcategories
        $accessoriesSubs = ['Watches', 'Sunglasses', 'Belts', 'Hats'];
        foreach ($accessoriesSubs as $title) {
            Category::create([
                'parent_id' => $accessories->id,
                'title' => $title,
                'slug' => 'accessories-' . Str::slug($title),
                'status' => true,
            ]);
        }
    }
}