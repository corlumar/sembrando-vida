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
        $driver = config('database.default');

        if ($driver === 'mysql') {
            // MySQL: CHANGE column (preserve varchar(150) NOT NULL)
            DB::statement("ALTER TABLE `users` CHANGE `nombre(s)` `name` VARCHAR(150) NOT NULL");
        } elseif ($driver === 'sqlite') {
            // SQLite 3.25+ supports RENAME COLUMN
            DB::statement('ALTER TABLE users RENAME COLUMN "nombre(s)" TO name');
        } else {
            // Fallback to schema builder (may require doctrine/dbal)
            Schema::table('users', function (Blueprint $table) {
                $table->renameColumn('nombre(s)', 'name');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
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
    }
};
