<?php

// database/migrations/YYYY_MM_DD_create_orders_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique(); // Unique order number
            $table->foreignId('customer_id')->constrained('customerdetails')->onDelete('cascade'); // Foreign key to the customerdetails table
            $table->decimal('total_price', 10, 2); // Total price of the order
            $table->decimal('tax', 10, 2)->nullable(); // Tax applied to the order
            $table->decimal('discount', 10, 2)->nullable(); // Discount applied to the order
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled', 'shipped']); // Order status
            $table->enum('payment_mode', ['COD', 'POD', 'Credit Card', 'Debit Card', 'Online Payment']); // Mode of payment
            $table->string('shipping_address'); // Shipping address for the order
            $table->string('shipping_method')->nullable(); // Shipping method (e.g., Standard, Express)
            $table->string('tracking_number')->nullable(); // Tracking number for the shipment
            $table->enum('shipment_status', ['pending', 'shipped', 'in_transit', 'delivered', 'failed'])->default('pending'); // Shipping status
            $table->date('estimated_delivery_date')->nullable(); // Estimated delivery date
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
