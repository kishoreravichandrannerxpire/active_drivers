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
    Schema::create('driver_availability', function (Blueprint $table) {
        $table->id();
        $table->foreignId('driver_id')->constrained('drivers');
        $table->date('available_date');
        $table->time('start_time');
        $table->time('end_time');
        $table->boolean('status')->default(0);
        $table->timestamps();
    });

    Schema::create('driver_availability_history', function (Blueprint $table) {
        $table->id();
        $table->foreignId('driver_availability_id')->constrained('driver_availability');
        $table->foreignId('driver_id')->constrained('drivers');
        $table->date('date');
        $table->time('start_time');
        $table->time('end_time');
        $table->boolean('status')->default(0);
        $table->string('action');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_availability');
        Schema::dropIfExists('driver_availability_history');    
    }
};
