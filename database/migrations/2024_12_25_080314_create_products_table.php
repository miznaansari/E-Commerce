<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name', 150); // Product Name
            $table->text('description'); // Product Description
            $table->decimal('price', 10, 2); // Product Price
            $table->integer('stock'); // Product Stock
            $table->unsignedBigInteger('category_id'); // Foreign Key for Category
            $table->string('thumbnail', 255); // Product Thumbnail
            $table->timestamps(); // created_at and updated_at

            // Foreign Key Constraint
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
