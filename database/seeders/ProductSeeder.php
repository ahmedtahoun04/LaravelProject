<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Men - T-Shirts
            ['title' => 'Classic White T-Shirt', 'category' => 'T-Shirts', 'price' => 29.99, 'stock' => 50],
            ['title' => 'Black Polo Shirt', 'category' => 'T-Shirts', 'price' => 39.99, 'stock' => 30],
            ['title' => 'Striped Cotton Tee', 'category' => 'T-Shirts', 'price' => 24.99, 'stock' => 45],

            // Men - Pants
            ['title' => 'Slim Fit Jeans', 'category' => 'Pants', 'price' => 79.99, 'stock' => 25],
            ['title' => 'Chino Pants', 'category' => 'Pants', 'price' => 69.99, 'stock' => 20],

            // Women - Dresses
            ['title' => 'Floral Summer Dress', 'category' => 'Dresses', 'price' => 89.99, 'stock' => 15],
            ['title' => 'Evening Gown', 'category' => 'Dresses', 'price' => 149.99, 'stock' => 10],

            // Women - Tops
            ['title' => 'Silk Blouse', 'category' => 'Tops', 'price' => 59.99, 'stock' => 20],
            ['title' => 'Casual Crop Top', 'category' => 'Tops', 'price' => 34.99, 'stock' => 35],

            // Kids
            ['title' => 'Kids Denim Jacket', 'category' => 'Kids Jackets', 'price' => 49.99, 'stock' => 20],
            ['title' => 'Girls Pink Dress', 'category' => 'Girls Dresses', 'price' => 39.99, 'stock' => 25],

            // Accessories
            ['title' => 'Leather Belt', 'category' => 'Belts', 'price' => 29.99, 'stock' => 40],
            ['title' => 'Classic Sunglasses', 'category' => 'Sunglasses', 'price' => 49.99, 'stock' => 30],
        ];

        foreach ($products as $item) {
            $category = Category::where('title', $item['category'])->first();
            
            if ($category) {
                Product::create([
                    'category_id' => $category->id,
                    'title'       => $item['title'],
                    'slug' => Str::slug($item['title']),
                    'price'       => $item['price'],
                    'stock'       => $item['stock'],
                    'status'      => true,
                ]);
            }
        }
    }
}