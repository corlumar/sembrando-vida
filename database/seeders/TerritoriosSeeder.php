<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TerritoriosSeeder extends Seeder
{
    public function run(): void
    {
        $regiones = DB::table('regiones')->pluck('id', 'nombre');

        $territorios = [
            ['nombre' => 'Territorio A', 'region' => 'Región Istmo'],
            ['nombre' => 'Territorio B', 'region' => 'Región Costa'],
        ];

        foreach ($territorios as $t) {
            $payload = ['region_id' => $regiones[$t['region']] ?? null];
            if (\Illuminate\Support\Facades\Schema::hasColumn('territorios', 'created_at')) {
                $payload['created_at'] = now();
                $payload['updated_at'] = now();
            }
            DB::table('territorios')->updateOrInsert(['nombre' => $t['nombre']], $payload);
        }
    }
}
