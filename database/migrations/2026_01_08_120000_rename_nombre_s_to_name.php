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
        // No-op: Migration now creates 'name' directly, no renaming needed.
        // This migration is kept for backwards compatibility with existing databases.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op: This migration is safe to rollback (it's now a no-op).
    }
};
