<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorCountsTable extends Migration
{
    public function up()
    {
        Schema::create('visitor_counts', function (Blueprint $table) {
            $table->id();
            $table->string('route')->unique(); // Store route name (e.g., '/product')
            $table->integer('count')->default(0); // Store the count
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visitor_counts');
    }
}
