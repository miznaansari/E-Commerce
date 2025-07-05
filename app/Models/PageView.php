<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    use HasFactory;

    // Define the table name if it's different from the pluralized model name
    protected $table = 'page_views';

    // Define the fillable properties
    protected $fillable = ['page_url', 'views'];

    // Timestamps are enabled by default, so we don't need to change this
}
