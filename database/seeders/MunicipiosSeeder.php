<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MunicipiosSeeder extends Seeder
{
    public function run(): void
    {
        $estados = DB::table('estados')->pluck('id', 'nombre');

        $municipios = [
            ['nombre' => 'Juchitán', 'estado' => 'Oaxaca'],
            ['nombre' => 'Matías Romero', 'estado' => 'Oaxaca'],
        ];

        foreach ($municipios as $m) {
            $payload = ['estado_id' => $estados[$m['estado']] ?? null];
            if (\Illuminate\Support\Facades\Schema::hasColumn('municipios', 'created_at')) {
                $payload['created_at'] = now();
                $payload['updated_at'] = now();
            }
            DB::table('municipios')->updateOrInsert(['nombre' => $m['nombre']], $payload);
        }
    }
}
