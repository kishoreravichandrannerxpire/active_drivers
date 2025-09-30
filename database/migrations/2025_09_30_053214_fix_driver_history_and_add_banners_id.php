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
        Schema::table('drivers_history', function (Blueprint $table) {
            $table->renameColumn('hill_expericence', 'hill_experience'); // correct spelling
        });

        Schema::table('banners_history', function (Blueprint $table) {
            $table->foreignId('banners_id')->constrained('banners')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('driver_history', function (Blueprint $table) {
            //
        });
    }
};
