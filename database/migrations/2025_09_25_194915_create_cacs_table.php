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
        Schema::create('cacs', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('representante_id')->nullable()->constrained('users');
            $table->decimal('latitud',10,7)->nullable();
            $table->decimal('longitud',10,7)->nullable();
            $table->foreignId('ruta_id')->constrained('rutas');
            $table->foreignId('municipio_id')->constrained('municipios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cacs');
    }
};
