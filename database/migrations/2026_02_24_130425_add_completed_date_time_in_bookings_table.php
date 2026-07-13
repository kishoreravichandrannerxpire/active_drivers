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
        Schema::table('bookings', function (Blueprint $table) {
            $table->timestamp('completed_date_time')->nullable()->after('pickup_date_time');
        });

        Schema::table('bookings_history', function (Blueprint $table) {
            $table->timestamp('completed_date_time')->nullable()->after('pickup_date_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('completed_date_time');
        });

        Schema::table('bookings_history', function (Blueprint $table) {
            $table->dropColumn('completed_date_time');
        });
    }
};
