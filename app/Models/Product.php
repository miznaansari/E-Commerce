<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
        'thumbnail',
    ];
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // Relationship to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship to OrderItem (a product can appear in multiple order items)
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    // Relationship to Order through OrderItems (a product can appear in many orders through order items)
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items', 'product_id', 'order_id')
                    ->withPivot('quantity', 'price') // Access additional columns in the pivot table
                    ->withTimestamps(); // Adds created_at and updated_at columns in the pivot table
    }

    public function cartItems()
{
    return $this->hasMany(CartItem::class, 'product_id');
}

}
