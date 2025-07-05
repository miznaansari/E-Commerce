<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImagesTable extends Migration
{
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Foreign Key to Products Table
            $table->string('image_path'); // Path for the image
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_images');
    }
}
