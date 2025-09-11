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
        schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->string('mobile_number')->unique();
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
            $table->softDeletes(); 
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('drivers');    
    }
};
