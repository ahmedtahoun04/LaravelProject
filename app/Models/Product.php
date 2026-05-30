<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'keywords',
        'description',
        'detail',
        'image',
        'price',
        'stock',
        'discount',
        'status',
    ];

    /**
     * Get the product's image URL.
     */
    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return 'https://placehold.co/400x300?text=No+Image';
        }

        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        return asset('storage/' . $this->image);
    }

    /**
     * A product belongs to a category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}