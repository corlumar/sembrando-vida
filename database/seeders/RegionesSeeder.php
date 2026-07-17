<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionesSeeder extends Seeder
{
    public function run(): void
    {
        $regiones = [
            ['nombre' => 'Región Istmo'],
            ['nombre' => 'Región Costa'],
        ];

        foreach ($regiones as $r) {
            $payload = ['nombre' => $r['nombre']];
            if (\Illuminate\Support\Facades\Schema::hasColumn('regiones', 'created_at')) {
                $payload['created_at'] = now();
                $payload['updated_at'] = now();
            }
            DB::table('regiones')->updateOrInsert(['nombre' => $r['nombre']], $payload);
        }
    }
}
