<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSizesTable extends Migration
{
    public function up()
    {
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->unsignedBigInteger('product_id'); // Foreign Key for Products
            $table->string('size', 10); // Size (e.g., S, M, L, XL)
            $table->integer('stock'); // Stock for this size
            $table->timestamps(); // created_at and updated_at

            // Foreign Key Constraint
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_sizes');
    }
}
