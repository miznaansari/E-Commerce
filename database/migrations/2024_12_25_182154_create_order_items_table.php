<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Linking order_id
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Linking product_id
            $table->integer('quantity'); // Quantity of product in the order
            $table->decimal('price', 10, 2); // Price per item at the time of purchase
            $table->json('meta_data')->nullable(); // JSON column for additional attributes like size, color, etc.
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
