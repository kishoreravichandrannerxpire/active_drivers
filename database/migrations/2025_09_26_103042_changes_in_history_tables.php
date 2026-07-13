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
        Schema::table('customers_history', function (Blueprint $table) {
            $table->boolean('is_blocked')->default(0)->change();
             // Drop the unique index on mobile_number
            $table->dropUnique('customers_history_mobile_number_unique');
            // Optional: keep column definition (e.g., make sure it's string or integer)
            $table->string('mobile_number')->change();
            $table->softDeletes();
        });

        Schema::table('drivers_history', function (Blueprint $table) {
            $table->boolean('is_blocked')->default(0)->change();
            $table->string('created_by')->default('admin')->change();
             // Drop the unique index on mobile_number
            $table->dropUnique('drivers_history_mobile_number_unique');
            // Optional: keep column definition (e.g., make sure it's string or integer)
            $table->string('mobile_number')->change();
            $table->dropUnique('drivers_history_driver_license_number_unique');
            $table->string('driver_license_number')->change();
            $table->softDeletes();
        });

        Schema::table('driver_availability_history', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('driver_availability', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('cars_history', function (Blueprint $table) {
            $table->softDeletes();
            $table->dropUnique('cars_history_car_number_unique');
            $table->string('car_number')->change();
        }); 

        Schema::table('cars', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('users_history', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('roles_history', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('permissions_history', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('bookings_history', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::create('banners_history', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->string('image');
            $table->string('alt_text');
            $table->string('link')->nullable();
            $table->boolean('status')->default(0);
            $table->string('created_by')->default('admin');
            $table->string('action');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('banners', function (Blueprint $table) {
            $table->softDeletes();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('history_tables', function (Blueprint $table) {
            $table->boolean('is_blocked')->default(0)->change();
            // Recreate the unique index on mobile_number
            $table->unique('mobile_number');
            // Optional: revert column definition if needed
            $table->string('mobile_number')->change();
            $table->dropSoftDeletes();
        });

        Schema::table('drivers_history', function (Blueprint $table) {
            $table->boolean('is_blocked')->default(0)->change();
            $table->string('created_by')->default('admin')->change();
            // Recreate the unique index on mobile_number
            $table->unique('mobile_number');
            // Optional: revert column definition if needed
            $table->string('mobile_number')->change();
            $table->unique('driver_license_number');
            $table->string('driver_license_number')->change();
            $table->dropSoftDeletes();
        });
        Schema::table('driver_availability_history', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('driver_availability', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('cars_history', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->unique('car_number');
            $table->string('car_number')->change();
        });
        Schema::table('cars', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('users_history', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('roles_history', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('permissions_history', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('bookings_history', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('banners_history');
        Schema::table('banners', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

    }
};
