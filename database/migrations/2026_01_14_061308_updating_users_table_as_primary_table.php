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
        Schema::table('users', function (Blueprint $table) {
            //add new columns
            $table->string('mobile_number',20)->unique()->after('email');
            $table->integer('failed_attempts')->default(0)->after('password');
            $table->boolean('is_blocked')->default(false)->after('failed_attempts');
            //drop old columns
            $table->dropColumn('name');
        });

        schema::table('users_history', function (Blueprint $table) {
            //add new columns
            $table->string('mobile_number',20)->unique()->after('email');
            $table->integer('failed_attempts')->default(0)->after('password');
            $table->boolean('is_blocked')->default(false)->after('failed_attempts');
            //drop old columns
            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //add old columns back
            $table->string('name')->after('id');
            //drop new columns
            $table->dropColumn('mobile_number');
            $table->dropColumn('failed_attempts');
            $table->dropColumn('is_blocked');
        });

        schema::table('users_history', function (Blueprint $table) {
            //add old columns back
            $table->string('name')->after('id');
            //drop new columns
            $table->dropColumn('mobile_number');
            $table->dropColumn('failed_attempts');
            $table->dropColumn('is_blocked');
        });
    }
};
