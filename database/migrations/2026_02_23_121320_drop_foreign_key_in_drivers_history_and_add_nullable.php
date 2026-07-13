<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->string('driver_license_number')->nullable(true)->change();
            $table->string('last_name')->nullable(true)->change();
            $table->string('driver_image')->nullable(true)->change();
            $table->string('total_experience_years')->nullable(true)->change();
            $table->string('hill_experience')->nullable(true)->change();
            $table->string('accident_history')->nullable(true)->change();
            $table->string('luxury_car_experience')->nullable(true)->change();
            $table->string('address')->nullable(true)->change();
            $table->string('pincode')->nullable(true)->change();
            $table->string('status')->nullable(true)->change();
            $table->string('address')->nullable(true)->change();
            $table->integer('age')->nullable(true)->change();
        });

         Schema::table('drivers_history', function (Blueprint $table) {
            $table->string('driver_license_number')->nullable(true)->change();
            $table->string('last_name')->nullable(true)->change();
            $table->string('driver_image')->nullable(true)->change();
            $table->string('total_experience_years')->nullable(true)->change();
            $table->string('hill_experience')->nullable(true)->change();
            $table->string('accident_history')->nullable(true)->change();
            $table->string('luxury_car_experience')->nullable(true)->change();
            $table->string('address')->nullable(true)->change();
            $table->string('pincode')->nullable(true)->change();
            $table->string('status')->nullable(true)->change();
            $table->string('address')->nullable(true)->change();
            $table->integer('age')->nullable(true)->change();
            // Drop foreign key
            $table->dropForeign('drivers_history_user_id_foreign');
            // OR (recommended & safer)
            // $table->dropForeign(['user_id']);
        });
    }

    public function down()
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->string('last_name')->nullable(false)->change();
            $table->string('driver_license_number')->nullable(false)->change();
            $table->string('driver_image')->nullable(false)->change();
            $table->string('total_experience_years')->nullable(false)->change();
            $table->string('hill_experience')->nullable(false)->change();
            $table->string('accident_history')->nullable(false)->change();
            $table->string('luxury_car_experience')->nullable(false)->change();
            $table->string('address')->nullable(false)->change();
            $table->string('pincode')->nullable(false)->change();
            $table->string('status')->nullable(false)->change();
            $table->integer('age')->nullable(false)->change();
        });

        Schema::table('drivers_history', function (Blueprint $table) {
            $table->string('last_name')->nullable(false)->change();
            $table->string('driver_license_number')->nullable(false)->change();
            $table->string('driver_image')->nullable(false)->change();
            $table->string('total_experience_years')->nullable(false)->change();
            $table->string('hill_experience')->nullable(false)->change();
            $table->string('accident_history')->nullable(false)->change();
            $table->string('luxury_car_experience')->nullable(false)->change();
            $table->string('address')->nullable(false)->change();
            $table->string('pincode')->nullable(false)->change();
            $table->string('status')->nullable(false)->change();
            $table->integer('age')->nullable(false)->change();
            // Re-add foreign key (no cascade)
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
        });
    }
};