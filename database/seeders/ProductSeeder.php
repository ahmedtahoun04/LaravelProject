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
            [
                'title'    => 'Classic White T-Shirt',
                'category' => 'T-Shirts',
                'price'    => 29.99,
                'stock'    => 50,
                'image'    => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=400',
            ],
            [
                'title'    => 'Black Polo Shirt',
                'category' => 'T-Shirts',
                'price'    => 39.99,
                'stock'    => 30,
                'image'    => 'https://images.unsplash.com/photo-1586363104862-3a5e2ab60d99?w=400',
            ],
            [
                'title'    => 'Slim Fit Jeans',
                'category' => 'Pants',
                'price'    => 79.99,
                'stock'    => 25,
                'image'    => 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=400',
            ],
            [
                'title'    => 'Chino Pants',
                'category' => 'Pants',
                'price'    => 69.99,
                'stock'    => 20,
                'image'    => 'https://images.unsplash.com/photo-1473966968600-fa801b869a1a?w=400',
            ],
            [
                'title'    => 'Floral Summer Dress',
                'category' => 'Dresses',
                'price'    => 89.99,
                'stock'    => 15,
                'image'    => 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?w=400',
            ],
            [
                'title'    => 'Evening Gown',
                'category' => 'Dresses',
                'price'    => 149.99,
                'stock'    => 10,
                'image'    => 'https://images.unsplash.com/photo-1566174053879-31528523f8ae?w=400',
            ],
            [
                'title'    => 'Silk Blouse',
                'category' => 'Tops',
                'price'    => 59.99,
                'stock'    => 20,
                'image'    => 'https://images.unsplash.com/photo-1564257631407-4deb1f99d992?w=400',
            ],
            [
                'title'    => 'Casual Crop Top',
                'category' => 'Tops',
                'price'    => 34.99,
                'stock'    => 35,
                'image'    => 'https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?w=400',
            ],
            [
                'title'    => 'Leather Belt',
                'category' => 'Belts',
                'price'    => 29.99,
                'stock'    => 40,
                'image'    => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=400',
            ],
            [
                'title'    => 'Classic Sunglasses',
                'category' => 'Sunglasses',
                'price'    => 49.99,
                'stock'    => 30,
                'image'    => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=400',
            ],
            [
                'title'    => 'Sport Sneakers',
                'category' => 'Shoes',
                'price'    => 89.99,
                'stock'    => 20,
                'image'    => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400',
            ],
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
                    'image'       => $item['image'],
                    'status'      => true,
                ]);
            }
        }
    }
}