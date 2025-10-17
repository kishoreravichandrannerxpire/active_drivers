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
            $table->string('permission')->change();
            $table->boolean('effect')->default(0)->change();
        });
         Schema::table('permissions_history', function (Blueprint $table) {
            $table->string('permission')->change();
            $table->boolean('effect')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->boolean('permission')->default(0);
             $table->string('effect')->after('module');

        });
        Schema::table('permissions_history', function (Blueprint $table) {
            $table->boolean('permission')->default(0);
             $table->string('effect')->after('module');

        });
    }
};
