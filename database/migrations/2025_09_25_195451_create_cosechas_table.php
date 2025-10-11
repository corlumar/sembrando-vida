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
        Schema::create('cosechas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sembrador_id')->constrained('sembradores');
            $table->foreignId('cultivo_id')->constrained('cultivos');
            $table->date('fecha_siembra')->nullable();
            $table->date('fecha_cosecha')->nullable();
            $table->decimal('cantidad',10,2);
            $table->boolean('multi_anual')->default(false);
            $table->decimal('latitud',10,7)->nullable();
            $table->decimal('longitud',10,7)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cosechas');
    }
};
