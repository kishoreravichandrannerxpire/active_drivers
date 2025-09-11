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
        schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customers_id')->constrained('customers');
            $table->foreignId('drivers_id')->constrained('drivers');
            $table->boolean('journey_type');
            $table->enum('status', ['pending', 'accepted', 'completed', 'cancelled'])->default('pending');
            $table->string('pickup_location');
            $table->string('drop_location');
            $table->string('from_postcode');
            $table->string('to_postcode');
            $table->timestamp('pickup_date_time');
            $table->integer('passengers');
            $table->boolean('payment_status');
            $table->decimal('fare',8,2);
            $table->string('distance');
            $table->string('duration');
            $table->timestamp('cancel_date_time')->nullable();
            $table->timestamp('booking_time')->useCurrent();
            $table->softDeletes();
            $table->timestamps();
        });

        schema::create('bookings_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bookings_id')->constrained('bookings');
            $table->foreignId('customers_id')->constrained('customers');
            $table->foreignId('drivers_id')->constrained('drivers');
            $table->boolean('journey_type');
            $table->enum('status', ['pending', 'accepted', 'completed', 'cancelled'])->default('pending');
            $table->string('pickup_location');
            $table->string('drop_location');
            $table->string('from_postcode');
            $table->string('to_postcode');
            $table->timestamp('pickup_date_time');
            $table->integer('passengers');
            $table->boolean('payment_status');
            $table->decimal('fare',8,2);
            $table->string('distance');
            $table->string('duration');
            $table->timestamp('cancel_date_time')->nullable();
            $table->timestamp('booking_time')->useCurrent();
            $table->string('action');
            $table->timestamps();

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('bookings');
        schema::dropIfExists('bookings_history');
    }
};
