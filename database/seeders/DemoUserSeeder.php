<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DemoUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener IDs de roles
        $roles = DB::table('roles')->pluck('id', 'name');

        $users = [
            [
                'name' => 'Admin',
                'apellido_paterno' => 'General',
                'apellido_materno' => 'Sistema',
                'curp' => 'ADMIN000000000000',
                'email' => 'admin@sembrando-vida.org',
                'celular' => '9610000000',
                'password' => Hash::make('123456'),
                'role_id' => $roles['Administrativo'] ?? 1,
            ],
            [
                'name' => 'Carlos',
                'apellido_paterno' => 'Lopez',
                'apellido_materno' => 'Torres',
                'curp' => 'CORD000000000000',
                'email' => 'coordinador@sembrando-vida.org',
                'celular' => '9610000001',
                'password' => Hash::make('123456'),
                'role_id' => $roles['Coordinador Territorial'] ?? 2,
            ],
            [
                'name' => 'Maria',
                'apellido_paterno' => 'Perez',
                'apellido_materno' => 'Santos',
                'curp' => 'ENLA000000000000',
                'email' => 'enlace@sembrando-vida.org',
                'celular' => '9610000002',
                'password' => Hash::make('123456'),
                'role_id' => $roles['Enlace Comercial'] ?? 3,
            ],
            [
                'name' => 'Jose',
                'apellido_paterno' => 'Hernandez',
                'apellido_materno' => 'Gomez',
                'curp' => 'TECN000000000000',
                'email' => 'tecnico@sembrando-vida.org',
                'celular' => '9610000003',
                'password' => Hash::make('123456'),
                'role_id' => $roles['Técnico'] ?? 4,
            ],
            [
                'name' => 'Ana',
                'apellido_paterno' => 'Martinez',
                'apellido_materno' => 'Ruiz',
                'curp' => 'SEMB000000000000',
                'email' => 'sembrador@sembrando-vida.org',
                'celular' => '9610000004',
                'password' => Hash::make('123456'),
                'role_id' => $roles['Sembrador'] ?? 5,
            ],
        ];

        foreach ($users as $user) {
            // Use DB to avoid mass-assignment / mismatched model fillable
            $insert = [
                'nombre(s)' => $user['name'],
                'apellido_paterno' => $user['apellido_paterno'],
                'apellido_materno' => $user['apellido_materno'],
                'curp' => $user['curp'],
                'email' => $user['email'],
                'celular' => $user['celular'],
                'password' => $user['password'],
                'role_id' => $user['role_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            DB::table('users')->updateOrInsert(['email' => $user['email']], $insert);
        }
    }
}
