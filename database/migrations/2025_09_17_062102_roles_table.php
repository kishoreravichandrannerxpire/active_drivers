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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name');
            $table->softDeletes();  
            $table->timestamps();
        }); 

         Schema::create('roles_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('roles_id')->constrained('roles');
            $table->string('role_name');
            $table->string('action');
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');  
        Schema::dropIfExists('roles_history');
    }
};
