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
        schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customers_id')->constrained('customers')->onUpdate('cascade');
            $table->string('car_model');
            $table->string('car_type');
            $table->string('car_number')->unique();
            $table->boolean('insurance');
            $table->boolean('fastag');
            $table->string('transmission_type');
            $table->string('fuel_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('cars');
    }
};
