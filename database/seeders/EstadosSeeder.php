<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosSeeder extends Seeder
{
    public function run(): void
    {
        $estados = [
            ['nombre' => 'Oaxaca'],
            ['nombre' => 'Chiapas'],
        ];

        foreach ($estados as $e) {
            $payload = ['nombre' => $e['nombre']];
            if (\Illuminate\Support\Facades\Schema::hasColumn('estados', 'created_at')) {
                $payload['created_at'] = now();
                $payload['updated_at'] = now();
            }
            DB::table('estados')->updateOrInsert(['nombre' => $e['nombre']], $payload);
        }
    }
}
