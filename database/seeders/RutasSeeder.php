<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RutasSeeder extends Seeder
{
    public function run(): void
    {
        $territorios = DB::table('territorios')->pluck('id', 'nombre');

        $rutas = [
            ['nombre' => 'Ruta 1', 'territorio' => 'Territorio A'],
            ['nombre' => 'Ruta 2', 'territorio' => 'Territorio B'],
        ];

        foreach ($rutas as $r) {
            $payload = ['territorio_id' => $territorios[$r['territorio']] ?? null];
            if (\Illuminate\Support\Facades\Schema::hasColumn('rutas', 'created_at')) {
                $payload['created_at'] = now();
                $payload['updated_at'] = now();
            }
            DB::table('rutas')->updateOrInsert(['nombre' => $r['nombre']], $payload);
        }
    }
}
