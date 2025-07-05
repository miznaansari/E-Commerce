<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Customerdetail extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_number',
        'address',
        'city',
        'state',
        'country',
        'zip_code',
        'profile_picture',
        'company_name',
        'role',
        'email_verified',
        'phone_verified'
    ];

    public function cart()
    {
        return $this->hasOne(Cart::class, 'customer_id');
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
