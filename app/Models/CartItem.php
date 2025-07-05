<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    // In CartItem model, ensure these fields are fillable
protected $fillable = ['cart_id', 'product_id','size', 'color', 'quantity', 'price'];


    public function cart()
{
    return $this->belongsTo(Cart::class, 'cart_id');
}

public function product()
{
    return $this->belongsTo(Product::class, 'product_id');
}

}
