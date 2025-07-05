<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Add the fillable property
    protected $fillable = [
        'customer_id', // This field is mass-assignable
    ];

    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customerdetail::class, 'customer_id');
    }
}
