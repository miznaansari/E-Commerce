<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name', 100); // Category Name
            $table->text('description')->nullable(); // Category Description
            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
