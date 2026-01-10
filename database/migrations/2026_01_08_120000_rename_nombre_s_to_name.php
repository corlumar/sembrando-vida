<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Make migration resilient: if old column exists, rename it; otherwise ensure `name` exists.
        if (Schema::hasColumn('users', 'nombre(s)')) {
            $driver = config('database.default');

            if ($driver === 'mysql') {
                DB::statement("ALTER TABLE `users` CHANGE `nombre(s)` `name` VARCHAR(150) NOT NULL");
            } elseif ($driver === 'sqlite') {
                DB::statement('ALTER TABLE users RENAME COLUMN "nombre(s)" TO name');
            } else {
                Schema::table('users', function (Blueprint $table) {
                    $table->renameColumn('nombre(s)', 'name');
                });
            }
        } else {
            if (!Schema::hasColumn('users', 'name')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('name', 150)->nullable();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse: if `name` exists and `nombre(s)` does not, try to rename back. Otherwise drop `name` if it was added by up().
        if (Schema::hasColumn('users', 'name') && !Schema::hasColumn('users', 'nombre(s)')) {
            $driver = config('database.default');

            if ($driver === 'mysql') {
                DB::statement("ALTER TABLE `users` CHANGE `name` `nombre(s)` VARCHAR(150) NOT NULL");
            } elseif ($driver === 'sqlite') {
                DB::statement('ALTER TABLE users RENAME COLUMN name TO "nombre(s)"');
            } else {
                Schema::table('users', function (Blueprint $table) {
                    $table->renameColumn('name', 'nombre(s)');
                });
            }
        } else {
            if (Schema::hasColumn('users', 'name')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('name');
                });
            }
        }
    }
};
