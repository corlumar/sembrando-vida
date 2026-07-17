<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SembradoresSeeder extends Seeder
{
    public function run(): void
    {
        $users = DB::table('users')->where('role_id', 5)->pluck('id');
        $cacs = DB::table('cacs')->pluck('id');
        $subroles = DB::table('subroles')->pluck('id');

        $i = 1;
        foreach ($users as $uid) {
            DB::table('sembradores')->updateOrInsert(
                ['user_id' => $uid],
                ['cac_id' => $cacs->first() ?? null, 'subrol_id' => $subroles->first() ?? null, 'genero' => ($i % 2) ? 'M' : 'F', 'edad' => 30 + $i, 'created_at' => now(), 'updated_at' => now()]
            );
            $i++;
        }
    }
}
