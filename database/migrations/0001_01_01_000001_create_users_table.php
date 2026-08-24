<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
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

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->boolean('activo')->default(true);

            $table->foreignId('role_id')
                ->nullable()
                ->constrained('roles')
                ->nullOnDelete();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
