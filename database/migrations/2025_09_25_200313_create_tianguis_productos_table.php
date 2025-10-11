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
        Schema::create('tianguis_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tianguis_id')->constrained('tianguis');
            $table->foreignId('cultivo_id')->constrained('cultivos');
            $table->decimal('cantidad_disponible',10,2);
            $table->decimal('precio',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tianguis_productos');
    }
};
