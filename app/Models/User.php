<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';  // Define the table name if it's not plural or follows a custom naming convention.
    
    // Define fillable attributes (mass assignment protection)
    protected $fillable = [
        'customer_id',
        'fcm_token',
    ];

    // Relationship with CustomerDetails model (assuming you have a CustomerDetails model)
    public function customer()
    {
        return $this->belongsTo(Customerdetail::class, 'customer_id', 'id');
    }
}
