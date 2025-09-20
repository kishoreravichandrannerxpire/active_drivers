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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('roles_id')->constrained('roles');
            $table->boolean('permission')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('permissions_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('roles_id')->constrained('roles');
            $table->foreignId('permissions_id')->constrained('permissions');
            $table->boolean('permission')->default(0);
            $table->string('action');
            $table->timestamps();
        });

         Schema::create('users_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained('users');
            $table->foreignId('roles_id')->constrained('roles');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('permissions_history');
        Schema::dropIfExists('users_history');
    }
};
