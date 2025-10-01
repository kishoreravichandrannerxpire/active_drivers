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
            $table->dropForeign(['cars_id'])->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings_histrory', function (Blueprint $table) {
            $table->foreign('cars_id')->references('id')->on('cars')->nullOnDelete();
        });
    }
};
