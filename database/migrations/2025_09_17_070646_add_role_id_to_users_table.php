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
        if (!Schema::hasColumn('users', 'deleted_at')) {
            $table->softDeletes();
        }

        if (!Schema::hasColumn('users', 'roles_id')) {
            $table->foreignId('roles_id')->constrained('roles')->after('id');
        }
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        if (Schema::hasColumn('users', 'deleted_at')) {
            $table->dropSoftDeletes();
        }

        if (Schema::hasColumn('users', 'roles_id')) {
            $table->dropForeign(['roles_id']);
            $table->dropColumn('roles_id');
        }
    });
}

};
