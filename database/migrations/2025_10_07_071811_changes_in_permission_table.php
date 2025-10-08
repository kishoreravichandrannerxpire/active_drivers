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
        Schema::table('permissions', function (Blueprint $table) {
            $table->string('module')->after('permission');
            $table->string('effect')->after('module');
            $table->string('user_created')->nullable();
            $table->string('user_modified')->nullable();
        });

        Schema::table('permissions_history', function (Blueprint $table) {
            $table->string('module')->after('permission');
            $table->string('effect')->after('module');
            $table->string('user_created')->nullable();
            $table->string('user_modified')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn(['module', 'effect', 'user_created', 'user_modified']);
        });
        Schema::table('permissions_history', function (Blueprint $table) {
            $table->dropColumn(['module', 'effect', 'user_created', 'user_modified']);
        });
    }
};
