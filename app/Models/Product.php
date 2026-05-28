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

    // Relationship مع Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}