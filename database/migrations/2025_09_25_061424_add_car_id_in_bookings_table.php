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
        // Bookings table
        Schema::table('bookings', function (Blueprint $table) {
            // Add cars_id if it doesn't exist
            if (!Schema::hasColumn('bookings', 'cars_id')) {
                $table->foreignId('cars_id')->constrained('cars')->after('drivers_id');
            }

            // Modify existing columns
            $table->boolean('payment_status')->nullable()->change();
            $table->decimal('fare', 8, 2)->nullable()->change();
            $table->string('distance')->nullable()->change();
            $table->string('duration')->nullable()->change();
            $table->string('status')->default('pending')->change();
        });

        // Bookings history table
        Schema::table('bookings_history', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings_history', 'cars_id')) {
                $table->foreignId('cars_id')->constrained('cars')->after('drivers_id');
            }

            $table->boolean('payment_status')->nullable()->change();
            $table->decimal('fare', 8, 2)->nullable()->change();
            $table->string('distance')->nullable()->change();
            $table->string('duration')->nullable()->change();
            $table->string('status')->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Bookings table
        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'cars_id')) {
                $table->dropForeign(['cars_id']);
                $table->dropColumn('cars_id');
            }

            // Revert nullable/type changes if needed
            $table->boolean('payment_status')->nullable(false)->change();
            $table->decimal('fare', 8, 2)->nullable(false)->change();
            $table->string('distance')->nullable(false)->change();
            $table->string('duration')->nullable(false)->change();
            // If status was originally enum, you'd need to handle it carefully
        });

        // Bookings history table
        Schema::table('bookings_history', function (Blueprint $table) {
            if (Schema::hasColumn('bookings_history', 'cars_id')) {
                $table->dropForeign(['cars_id']);
                $table->dropColumn('cars_id');
            }

            $table->boolean('payment_status')->nullable(false)->change();
            $table->decimal('fare', 8, 2)->nullable(false)->change();
            $table->string('distance')->nullable(false)->change();
            $table->string('duration')->nullable(false)->change();
        });
    }
};
