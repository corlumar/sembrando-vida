<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class MasterSeeder extends Seeder
{
    public function run(): void
    {
        // =======================
        //  Roles
        // =======================
        $roles = [
            'Administrativo',
            'Coordinador Territorial',
            'Enlace Comercial',
            'Técnico',
            'Sembrador',
        ];

        foreach ($roles as $rol) {
            DB::table('roles')->updateOrInsert(
                ['name' => $rol],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }

        $rolesMap = DB::table('roles')->pluck('id', 'name');

        // =======================
        //  Subroles
        // =======================
        $subroles = [
            'Técnico' => ['Facilitador', 'Productivo', 'Social'],
            'Sembrador' => ['Presidente', 'Secretario', 'Tesorero', 'Sembrador'],
        ];

        foreach ($subroles as $rol => $subs) {
            foreach ($subs as $sub) {
                DB::table('subroles')->updateOrInsert(
                    ['name' => $sub, 'role_id' => $rolesMap[$rol]],
                    ['created_at' => now(), 'updated_at' => now()]
                );
            }
        }

        // =======================
        //  Usuario Admin
        // =======================
        // Insert using DB to match actual users table columns
        $adminEmail = 'admin@sembrando-vida.org';
        $adminData = [
            'nombre(s)' => 'Admin',
            'apellido_paterno' => 'General',
            'apellido_materno' => 'Sistema',
            'curp' => 'ADMIN000000000000',
            'email' => $adminEmail,
            'celular' => '9610000000',
            'password' => Hash::make('123456'),
            'role_id' => $rolesMap['Administrativo'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('users')->updateOrInsert(['email' => $adminEmail], $adminData);
    }
}

