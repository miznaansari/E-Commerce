<?php

// app/Models/Order.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number', 
        'customer_id', 
        'total_price', 
        'tax', 
        'discount', 
        'status', 
        'payment_mode', 
        'shipping_address', 
        'shipping_method', 
        'tracking_number', 
        'shipment_status', 
        'estimated_delivery_date'
    ];

    // Relationships
    public function customer()
    {
        return $this->belongsTo(CustomerDetail::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
