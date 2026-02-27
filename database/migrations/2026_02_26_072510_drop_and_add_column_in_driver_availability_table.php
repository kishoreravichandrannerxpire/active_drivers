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
        // Update driver_availability table
        Schema::table('driver_availability', function (Blueprint $table) {

            // Drop old columns
            $table->dropColumn(['available_date', 'start_time', 'end_time']);

            // Make status nullable
            $table->boolean('status')->nullable()->default(1)->change();

            // Add new columns
            $table->timestamp('from_date_time')->after('drivers_id');
            $table->timestamp('to_date_time')->after('from_date_time');
        });

        // Update driver_availability_history table
        Schema::table('driver_availability_history', function (Blueprint $table) {

            // Drop old columns
            $table->dropColumn(['available_date', 'start_time', 'end_time']);

            // Make status nullable
            $table->boolean('status')->nullable()->default(1)->change();

            // Add new columns
            $table->timestamp('from_date_time')->after('drivers_id');
            $table->timestamp('to_date_time')->after('from_date_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rollback driver_availability
        Schema::table('driver_availability', function (Blueprint $table) {

            $table->date('available_date')->after('drivers_id');
            $table->time('start_time')->after('available_date');
            $table->time('end_time')->after('start_time');

            $table->boolean('status')->default(0)->change();

            $table->dropColumn(['from_date_time', 'to_date_time']);
        });

        // Rollback driver_availability_history
        Schema::table('driver_availability_history', function (Blueprint $table) {

            $table->date('available_date')->after('drivers_id');
            $table->time('start_time')->after('available_date');
            $table->time('end_time')->after('start_time');

            $table->boolean('status')->default(0)->change();

            $table->dropColumn(['from_date_time', 'to_date_time']);
        });
    }
};
