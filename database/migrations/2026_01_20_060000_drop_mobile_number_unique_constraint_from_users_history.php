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
        Schema::table('users_history', function (Blueprint $table) {
            // Drop the unique constraint on mobile_number
            $table->dropUnique('users_history_mobile_number_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users_history', function (Blueprint $table) {
            // Recreate the unique constraint if needed
            $table->unique('mobile_number', 'users_history_mobile_number_unique');
        });
    }
};
