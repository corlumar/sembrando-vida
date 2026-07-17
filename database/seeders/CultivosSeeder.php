<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CultivosSeeder extends Seeder
{
    public function run(): void
    {
        $cultivos = [
            ['nombre' => 'Maíz'],
            ['nombre' => 'Frijol'],
            ['nombre' => 'Calabaza'],
        ];

        foreach ($cultivos as $c) {
            $payload = ['nombre' => $c['nombre']];
            if (\Illuminate\Support\Facades\Schema::hasColumn('cultivos', 'created_at')) {
                $payload['created_at'] = now();
                $payload['updated_at'] = now();
            }
            DB::table('cultivos')->updateOrInsert(['nombre' => $c['nombre']], $payload);
        }
    }
}
