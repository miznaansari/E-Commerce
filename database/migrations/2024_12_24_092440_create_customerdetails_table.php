<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customerdetails', function (Blueprint $table) {
            $table->id();
            $table->string('first_name'); // Customer's first name
            $table->string('last_name'); // Customer's last name
            $table->string('email')->unique(); // Unique email address
            $table->string('dob'); // Unique email address

            $table->string('phone_number')->unique(); // Unique phone number
            $table->string('password'); // Encrypted password
            $table->text('address')->nullable(); // Full address (nullable)
            $table->string('city')->nullable(); // City name (nullable)
            $table->string('state')->nullable(); // State name (nullable)
            $table->string('country')->nullable(); // Country name (nullable)
            $table->string('zip_code')->nullable(); // Postal/ZIP code (nullable)
            $table->string('profile_picture')->nullable(); // Profile picture (optional)
            $table->string('company_name')->nullable(); // Company name (optional)
            $table->string('role')->default('customer'); // Role (e.g., customer, admin)
            $table->boolean('email_verified')->default(false); // Email verification status
            $table->boolean('phone_verified')->default(false); // Phone verification status
            $table->rememberToken(); // Token for "remember me" functionality
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customerdetails');
    }
};
