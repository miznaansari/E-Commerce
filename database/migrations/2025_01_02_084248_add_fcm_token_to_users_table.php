<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('fcm_token')->nullable();
            $table->timestamps();
        
            $table->foreign('customer_id')->references('id')->on('customerdetails')->onDelete('cascade');
        });
        
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
