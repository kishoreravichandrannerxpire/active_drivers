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
        Schema::table('drivers', function (Blueprint $table) {
            //add new columns
            $table->foreignId('user_id')
                  ->after('id')
                  ->constrained();

            $table->string('first_name')->after('user_id');
            $table->string('last_name')->after('first_name');
            
            //drop old columns
            $table->dropColumn([
                'name',
                'mobile_number',
                'password',
                'failed_attempts',
                'is_blocked',
            ]);

            Schema::table('drivers_history', function (Blueprint $table) {
                //add new columns
                $table->foreignId('user_id')
                      ->after('id')
                      ->constrained();

                $table->string('first_name')->after('user_id');
                $table->string('last_name')->after('first_name');
                
                //drop old columns
                $table->dropColumn([
                    'name',
                    'mobile_number',
                    'password',
                    'failed_attempts',
                    'is_blocked',
                ]);
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            //add old columns back
            $table->string('name')->after('id');
            $table->string('mobile_number',20)->unique()->after('name');
            $table->string('password')->after('mobile_number');
            $table->unsignedInteger('failed_attempts')->default(0)->after('pincode');
            $table->boolean('is_blocked')->default(0)->after('failed_attempts');

            //drop new columns
            $table->dropColumn([
                'user_id',
                'first_name',
                'last_name',
            ]);
        });

        Schema::table('drivers_history', function (Blueprint $table) {
            //add old columns back
            $table->string('name')->after('id');
            $table->string('mobile_number',20)->unique()->after('name');
            $table->string('password')->after('mobile_number');
            $table->unsignedInteger('failed_attempts')->default(0)->after('pincode');
            $table->boolean('is_blocked')->default(0)->after('failed_attempts');

            //drop new columns
            $table->dropColumn([
                'user_id',
                'first_name',
                'last_name',
            ]);
        });
    }
};
