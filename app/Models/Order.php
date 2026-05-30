<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'total',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'payment_method',
        'notes',
    ];

    /**
     * An order belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * An order has many items.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}