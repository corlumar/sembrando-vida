<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CacsSeeder extends Seeder
{
    public function run(): void
    {
        $rutas = DB::table('rutas')->pluck('id', 'nombre');
        $municipios = DB::table('municipios')->pluck('id', 'nombre');

        $cacs = [
            ['nombre' => 'CAC Centro', 'ruta' => 'Ruta 1', 'municipio' => 'Juchitán'],
            ['nombre' => 'CAC Norte', 'ruta' => 'Ruta 2', 'municipio' => 'Matías Romero'],
        ];

        foreach ($cacs as $c) {
            $payload = ['ruta_id' => $rutas[$c['ruta']] ?? null, 'municipio_id' => $municipios[$c['municipio']] ?? null];
            if (\Illuminate\Support\Facades\Schema::hasColumn('cacs', 'created_at')) {
                $payload['created_at'] = now();
                $payload['updated_at'] = now();
            }
            DB::table('cacs')->updateOrInsert(['nombre' => $c['nombre']], $payload);
        }
    }
}
