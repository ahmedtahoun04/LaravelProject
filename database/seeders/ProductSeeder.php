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
            ['title' => 'Classic White T-Shirt', 'category' => 'T-Shirts', 'price' => 29.99, 'stock' => 50, 'discount' => 0, 'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=400'],
            ['title' => 'Black Graphic Tee', 'category' => 'T-Shirts', 'price' => 34.99, 'stock' => 40, 'discount' => 10, 'image' => 'https://images.unsplash.com/photo-1503341504253-dff4815485f1?w=400'],
            ['title' => 'Navy Blue Polo', 'category' => 'T-Shirts', 'price' => 44.99, 'stock' => 30, 'discount' => 0, 'image' => 'https://images.unsplash.com/photo-1586363104862-3a5e2ab60d99?w=400'],
            ['title' => 'Striped Cotton Tee', 'category' => 'T-Shirts', 'price' => 24.99, 'stock' => 45, 'discount' => 15, 'image' => 'https://images.unsplash.com/photo-1562157873-818bc0726f68?w=400'],

            // Men - Pants
            ['title' => 'Slim Fit Jeans', 'category' => 'Pants', 'price' => 79.99, 'stock' => 25, 'discount' => 0, 'image' => 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=400'],
            ['title' => 'Chino Pants', 'category' => 'Pants', 'price' => 69.99, 'stock' => 20, 'discount' => 10, 'image' => 'https://images.unsplash.com/photo-1473966968600-fa801b869a1a?w=400'],
            ['title' => 'Black Skinny Jeans', 'category' => 'Pants', 'price' => 89.99, 'stock' => 15, 'discount' => 0, 'image' => 'https://images.unsplash.com/photo-1555689502-c4b22d76c56f?w=400'],

            // Men - Jackets
            ['title' => 'Leather Biker Jacket', 'category' => 'Jackets', 'price' => 199.99, 'stock' => 10, 'discount' => 20, 'image' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?w=400'],
            ['title' => 'Denim Jacket', 'category' => 'Jackets', 'price' => 89.99, 'stock' => 15, 'discount' => 0, 'image' => 'https://images.unsplash.com/photo-1523205771623-e0faa4d2813d?w=400'],

            // Women - Dresses
            ['title' => 'Floral Summer Dress', 'category' => 'Dresses', 'price' => 89.99, 'stock' => 15, 'discount' => 0, 'image' => 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?w=400'],
            ['title' => 'Evening Gown', 'category' => 'Dresses', 'price' => 149.99, 'stock' => 10, 'discount' => 15, 'image' => 'https://images.unsplash.com/photo-1566174053879-31528523f8ae?w=400'],
            ['title' => 'Casual Wrap Dress', 'category' => 'Dresses', 'price' => 69.99, 'stock' => 20, 'discount' => 0, 'image' => 'https://images.unsplash.com/photo-1585487000160-6ebcfceb0d03?w=400'],
            ['title' => 'Mini Floral Dress', 'category' => 'Dresses', 'price' => 59.99, 'stock' => 25, 'discount' => 10, 'image' => 'https://images.unsplash.com/photo-1496747611176-843222e1e57c?w=400'],

            // Women - Tops
            ['title' => 'Silk Blouse', 'category' => 'Tops', 'price' => 59.99, 'stock' => 20, 'discount' => 0, 'image' => 'https://images.unsplash.com/photo-1564257631407-4deb1f99d992?w=400'],
            ['title' => 'Casual Crop Top', 'category' => 'Tops', 'price' => 34.99, 'stock' => 35, 'discount' => 0, 'image' => 'https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?w=400'],
            ['title' => 'Linen Button Shirt', 'category' => 'Tops', 'price' => 49.99, 'stock' => 18, 'discount' => 20, 'image' => 'https://images.unsplash.com/photo-1485462537746-965f33f7f6a7?w=400'],

            // Women - Skirts
            ['title' => 'Pleated Mini Skirt', 'category' => 'Skirts', 'price' => 44.99, 'stock' => 22, 'discount' => 0, 'image' => 'https://images.unsplash.com/photo-1583496661160-fb5886a0aaaa?w=400'],
            ['title' => 'Maxi Boho Skirt', 'category' => 'Skirts', 'price' => 54.99, 'stock' => 18, 'discount' => 10, 'image' => 'https://images.unsplash.com/photo-1594938298603-c8148c4b4e7b?w=400'],

            // Kids
            ['title' => 'Kids Denim Jacket', 'category' => 'Boys', 'price' => 49.99, 'stock' => 20, 'discount' => 0, 'image' => 'https://images.unsplash.com/photo-1519238263530-99bdd11df2ea?w=400'],
            ['title' => 'Girls Pink Dress', 'category' => 'Girls', 'price' => 39.99, 'stock' => 25, 'discount' => 0, 'image' => 'https://images.unsplash.com/photo-1518831959646-742c3a14ebf7?w=400'],

            // Accessories
            ['title' => 'Leather Belt', 'category' => 'Belts', 'price' => 29.99, 'stock' => 40, 'discount' => 0, 'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=400'],
            ['title' => 'Classic Sunglasses', 'category' => 'Sunglasses', 'price' => 49.99, 'stock' => 30, 'discount' => 0, 'image' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=400'],
            ['title' => 'Aviator Sunglasses', 'category' => 'Sunglasses', 'price' => 59.99, 'stock' => 25, 'discount' => 15, 'image' => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?w=400'],
            ['title' => 'Luxury Watch', 'category' => 'Watches', 'price' => 299.99, 'stock' => 8, 'discount' => 0, 'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400'],
            ['title' => 'Sport Watch', 'category' => 'Watches', 'price' => 149.99, 'stock' => 15, 'discount' => 10, 'image' => 'https://images.unsplash.com/photo-1434056886845-dac89ffe9b56?w=400'],
            ['title' => 'Leather Handbag', 'category' => 'Bags', 'price' => 129.99, 'stock' => 12, 'discount' => 0, 'image' => 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=400'],
            ['title' => 'Canvas Tote Bag', 'category' => 'Bags', 'price' => 39.99, 'stock' => 30, 'discount' => 0, 'image' => 'https://images.unsplash.com/photo-1591561954555-607968c989ab?w=400'],
            ['title' => 'Baseball Cap', 'category' => 'Hats', 'price' => 24.99, 'stock' => 35, 'discount' => 0, 'image' => 'https://images.unsplash.com/photo-1588850561407-ed78c282e89b?w=400'],
            ['title' => 'Wool Beanie', 'category' => 'Hats', 'price' => 19.99, 'stock' => 40, 'discount' => 20, 'image' => 'https://images.unsplash.com/photo-1576871337632-b9aef4c17ab9?w=400'],

            // Shoes
            ['title' => 'Sport Sneakers', 'category' => 'Shoes', 'price' => 89.99, 'stock' => 20, 'discount' => 0, 'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400'],
            ['title' => 'White Leather Sneakers', 'category' => 'Shoes', 'price' => 99.99, 'stock' => 18, 'discount' => 10, 'image' => 'https://images.unsplash.com/photo-1560769629-975ec94e6a86?w=400'],
        ];

        foreach ($products as $item) {
            $category = Category::where('title', $item['category'])->first();

            if ($category) {
                Product::create([
                    'category_id' => $category->id,
                    'title'       => $item['title'],
                    'slug'        => Str::slug($item['title']),
                    'price'       => $item['price'],
                    'stock'       => $item['stock'],
                    'discount'    => $item['discount'],
                    'image'       => $item['image'],
                    'status'      => true,
                ]);
            }
        }
    }
}