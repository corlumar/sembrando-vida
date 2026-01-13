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
        // users.role_id -> roles.id
        if (Schema::hasTable('users') && Schema::hasTable('roles') && Schema::hasColumn('users', 'role_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null')->onUpdate('cascade');
            });
        }

        // cacs.representante_id -> users.id
        if (Schema::hasTable('cacs') && Schema::hasTable('users') && Schema::hasColumn('cacs', 'representante_id')) {
            Schema::table('cacs', function (Blueprint $table) {
                $table->foreign('representante_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            });
        }

        // sembradores.user_id -> users.id
        if (Schema::hasTable('sembradores') && Schema::hasTable('users') && Schema::hasColumn('sembradores', 'user_id')) {
            Schema::table('sembradores', function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('sembradores') && Schema::hasColumn('sembradores', 'user_id')) {
            Schema::table('sembradores', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }

        if (Schema::hasTable('cacs') && Schema::hasColumn('cacs', 'representante_id')) {
            Schema::table('cacs', function (Blueprint $table) {
                $table->dropForeign(['representante_id']);
            });
        }

        if (Schema::hasTable('users') && Schema::hasColumn('users', 'role_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropForeign(['role_id']);
            });
        }
    }
};
