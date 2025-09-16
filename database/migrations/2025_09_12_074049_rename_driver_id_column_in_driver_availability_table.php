<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        // Drop foreign keys first
        Schema::table('driver_availability', function (Blueprint $table) {
            $table->dropForeign(['driver_id']);
        });
        Schema::table('driver_availability_history', function (Blueprint $table) {
            $table->dropForeign(['driver_id']);
        });

        // Rename columns using raw SQL
        DB::statement('ALTER TABLE driver_availability CHANGE driver_id drivers_id BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE driver_availability_history CHANGE driver_id drivers_id BIGINT UNSIGNED NOT NULL');

        // Re-add foreign keys
        Schema::table('driver_availability', function (Blueprint $table) {
            $table->foreign('drivers_id')->references('id')->on('drivers')->onDelete('cascade');
        });
        Schema::table('driver_availability_history', function (Blueprint $table) {
            $table->foreign('drivers_id')->references('id')->on('drivers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        // Drop foreign keys first
        Schema::table('driver_availability', function (Blueprint $table) {
            $table->dropForeign(['drivers_id']);
        });
        Schema::table('driver_availability_history', function (Blueprint $table) {
            $table->dropForeign(['drivers_id']);
        });

        // Rename columns back using raw SQL
        DB::statement('ALTER TABLE driver_availability CHANGE drivers_id driver_id BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE driver_availability_history CHANGE drivers_id driver_id BIGINT UNSIGNED NOT NULL');

        // Re-add foreign keys
        Schema::table('driver_availability', function (Blueprint $table) {
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
        });
        Schema::table('driver_availability_history', function (Blueprint $table) {
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
        });
    }
};
