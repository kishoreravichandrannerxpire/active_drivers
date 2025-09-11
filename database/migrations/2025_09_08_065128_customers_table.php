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
        schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('mobile_number')->unique();
            $table->string('password');
            $table->unsignedInteger('failed_attempts')->default(0); 
            $table->boolean('is_blocked');
            $table->softDeletes();  
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('customers');  
    }
};
