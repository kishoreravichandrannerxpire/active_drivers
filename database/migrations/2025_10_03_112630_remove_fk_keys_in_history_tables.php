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
       Schema::table('bookings_history', function (Blueprint $table) {
        $table->dropForeign(['drivers_id']);
        $table->dropForeign(['customers_id']);
        $table->dropForeign(['cars_id']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings_history', function (Blueprint $table) {
            $table->foreign('drivers_id')->constrained('drivers');
            $table->foreign('customers_id')->constrained('customers');
            $table->foreign('cars_id')->constrained('cars');
        });
    }
};
