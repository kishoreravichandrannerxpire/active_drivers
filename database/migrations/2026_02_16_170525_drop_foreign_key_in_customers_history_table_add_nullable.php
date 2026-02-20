<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('customers_history', function (Blueprint $table) {
            $table->dropForeign('customers_history_user_id_foreign');
             $table->string('last_name')->nullable()->change();
        });

       Schema::table('customers', function (Blueprint $table) {
            $table->string('last_name')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('customers_history', function (Blueprint $table) {
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
            $table->string('last_name')->nullable(false)->change();
        });
        Schema::table('customers', function (Blueprint $table) {
            $table->string('last_name')->nullable(false)->change();
        });
    }
};

