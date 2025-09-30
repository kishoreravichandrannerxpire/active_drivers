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
        Schema::table('banners_history', function (Blueprint $table) {
        $table->unsignedBigInteger('banners_id')->nullable(false)->change(); // keep NOT NULL
    });
    
        Schema::table('cars_history', function (Blueprint $table) {
        $table->dropForeign(['cars_id']);   // drop FK
        $table->unsignedBigInteger('cars_id')->nullable(false)->change(); // keep NOT NULL
    });

        Schema::table('customers_history', function (Blueprint $table) {
        $table->dropForeign(['customers_id']);   // drop FK
        $table->unsignedBigInteger('customers_id')->nullable(false)->change(); // keep NOT NULL
    });

        Schema::table('drivers_history', function (Blueprint $table) {
        $table->dropForeign(['drivers_id']);   // drop FK
        $table->unsignedBigInteger('drivers_id')->nullable(false)->change(); // keep NOT NULL
    });

        Schema::table('driver_availability_history', function (Blueprint $table) {
        $table->dropForeign(['driver_availability_id']);   // drop FK
        $table->unsignedBigInteger('driver_availability_id')->nullable(false)->change(); // keep NOT NULL
    });
    
        Schema::table('bookings_history', function (Blueprint $table) {
        $table->dropForeign(['bookings_id']);   // drop FK
        $table->unsignedBigInteger('bookings_id')->nullable(false)->change(); // keep NOT NULL
    });

        Schema::table('users_history', function (Blueprint $table) {
        $table->dropForeign(['users_id']);   // drop FK
        $table->unsignedBigInteger('users_id')->nullable(false)->change(); // keep NOT NULL
    });

        Schema::table('permissions_history', function (Blueprint $table) {
        $table->dropForeign(['permissions_id']);   // drop FK
        $table->unsignedBigInteger('permissions_id')->nullable(false)->change(); // keep NOT NULL
    });

        Schema::table('roles_history', function (Blueprint $table) {
        $table->dropForeign(['roles_id']);   // drop FK
        $table->unsignedBigInteger('roles_id')->nullable(false)->change(); // keep NOT NULL
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('banners_history', function (Blueprint $table) {
        $table->foreign('banners_id')->references('id')->on('banners')->nullOnDelete();
    });

        Schema::table('cars_history', function (Blueprint $table) {
        $table->foreign('cars_id')->references('id')->on('cars')->nullOnDelete();
    });

        Schema::table('customers_history', function (Blueprint $table) {
        $table->foreign('customers_id')->references('id')->on('customers')->nullOnDelete();
    });

        Schema::table('drivers_history', function (Blueprint $table) {
        $table->foreign('drivers_id')->references('id')->on('drivers')->nullOnDelete();
    });

        Schema::table('driver_availability_history', function (Blueprint $table) {
        $table->foreign('driver_availability_id')->references('id')->on('driver_availability')->nullOnDelete();
    });

        Schema::table('bookings_history', function (Blueprint $table) {
        $table->foreign('bookings_id')->references('id')->on('bookings')->nullOnDelete();
    });

        Schema::table('users_history', function (Blueprint $table) {
        $table->foreign('users_id')->references('id')->on('users')->nullOnDelete();
    });

        Schema::table('permissions_history', function (Blueprint $table) {
        $table->foreign('permissions_id')->references('id')->on('permissions')->nullOnDelete();
    });

        Schema::table('roles_history', function (Blueprint $table) {
        $table->foreign('roles_id')->references('id')->on('roles')->nullOnDelete();
    });
    }
};
