<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            // Drop old foreign key
            $table->dropForeign(['customers_id']);

            // Add new foreign key with cascade
            $table->foreign('customers_id')
                  ->references('id')
                  ->on('customers')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
            $table->boolean('insurance')->nullable()->change();
            $table->boolean('fastag')->nullable()->change();
            $table->string('transmission_type')->nullable()->change();
            $table->string('fuel_type')->nullable()->change();
        });

        Schema::table('cars_history', function (Blueprint $table) {
            $table->boolean('insurance')->nullable()->change();
            $table->boolean('fastag')->nullable()->change();
            $table->string('transmission_type')->nullable()->change();
            $table->string('fuel_type')->nullable()->change();
        });

    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            // Drop cascade foreign key
            $table->dropForeign(['customers_id']);

            // Restore old foreign key (only update cascade, no delete cascade)
            $table->foreign('customers_id')
                  ->references('id')
                  ->on('customers')
                  ->cascadeOnUpdate();
            $table->boolean('insurance')->nullable(false)->change();
            $table->boolean('fastag')->nullable(false)->change();
            $table->string('transmission_type')->nullable(false)->change();
            $table->string('fuel_type')->nullable(false)->change();
        });

        Schema::table('cars_history', function (Blueprint $table) {
            $table->boolean('insurance')->nullable(false)->change();
            $table->boolean('fastag')->nullable(false)->change();
            $table->string('transmission_type')->nullable(false)->change();
            $table->string('fuel_type')->nullable(false)->change();
        });
    }
};

