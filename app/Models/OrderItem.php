<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'title',
        'price',
        'quantity',
    ];

    /**
     * An order item belongs to an order.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * An order item belongs to a product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}