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
        Schema::create('cosecha_fechas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cosecha_id')->constrained('cosechas')->onDelete('cascade');
            $table->date('fecha_evento');
            $table->enum('tipo',['siembra','cosecha']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cosecha_fechas');
    }
};
