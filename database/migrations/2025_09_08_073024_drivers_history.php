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
        schema::create('drivers_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('drivers_id')->constrained('drivers');
            $table->string('name');
            $table->integer('age');
            $table->integer('mobile_number')->unique();
            $table->boolean('status');
            $table->string('password');
            $table->string('driver_license_number')->unique();
            $table->string('driver_image');
            $table->integer('total_experience_years');
            $table->integer('hill_expericence');
            $table->string('accident_history');
            $table->boolean('luxury_car_experience');
            $table->string('address');
            $table->integer('pincode');
            $table->unsignedInteger('failed_attempts')->default(0);
            $table->boolean('is_blocked');  
            $table->string('created_by');
            $table->string('action');
            $table->timestamps();
        });

        schema::create('customers_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customers_id')->constrained('customers');
            $table->string('name');
            $table->integer('mobile_number')->unique();
            $table->string('password');
            $table->unsignedInteger('failed_attempts')->default(0); 
            $table->boolean('is_blocked');
            $table->string('action');  
            $table->timestamps();
        }); 

         schema::create('cars_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cars_id')->constrained('cars');
            $table->string('car_model');
            $table->string('car_type');
            $table->string('car_number')->unique();
            $table->boolean('insurance');
            $table->boolean('fastag');
            $table->string('transmission_type');
            $table->string('fuel_type');
            $table->string('action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('drivers_history');  
        schema::dropIfExists('customers_history');  
        schema::dropIfExists('cars_history');   

    }
};
