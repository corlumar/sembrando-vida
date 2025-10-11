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
        Schema::create('disponibilidades', function (Blueprint $table) {
    $table->id();
    $table->foreignId('cosecha_id')->constrained('cosechas')->onDelete('cascade');
    $table->decimal('cantidad_cosechada',10,2);
    $table->decimal('cantidad_autoconsumo',10,2)->default(0);
    $table->decimal('cantidad_produccion',10,2)->default(0);
    // Calculada con accessor en el modelo
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disponibilidad');
    }
};
