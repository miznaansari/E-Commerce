<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;

    // Define the table if it's not pluralized automatically
    protected $table = 'product_sizes';

    // Mass-assignable attributes
    protected $fillable = ['product_id', 'size', 'stock'];

    // Define relationship with Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
