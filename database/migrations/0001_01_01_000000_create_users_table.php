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
       Schema::create('users', function (Blueprint $table) {
    $table->id();

    $table->string('name', 150);
    $table->string('apellido_paterno', 150)->nullable();
    $table->string('apellido_materno', 150)->nullable();

    $table->string('curp', 18)->nullable()->unique();
    $table->string('email')->unique();
    $table->string('celular', 20)->nullable()->unique();
    $table->string('password');

    $table->boolean('activo')->default(true);

    $table->unsignedBigInteger('role_id')->nullable();
    $table->unsignedBigInteger('estado_id')->nullable();
    $table->unsignedBigInteger('municipio_id')->nullable();
    $table->unsignedBigInteger('region_id')->nullable();
    $table->unsignedBigInteger('territorio_id')->nullable();
    $table->string('ruta', 255)->nullable();

    $table->rememberToken();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
