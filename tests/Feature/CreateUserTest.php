<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_user()
    {
        // seed roles
        $this->seed(\Database\Seeders\MasterSeeder::class);

        $roles = \DB::table('roles')->pluck('id', 'name');

        // create admin
        $admin = User::factory()->create([
            'name' => 'AdminTest',
            'email' => 'admintest@example.com',
            'password' => Hash::make('password'),
            'role_id' => $roles['Administrativo'] ?? 1,
        ]);

        $this->actingAs($admin)
            ->post(route('usuarios.store'), [
                'name' => 'Nuevo',
                'apellido_paterno' => 'Usuario',
                'apellido_materno' => 'Prueba',
                'curp' => 'PRUEBA000000000001',
                'email' => 'nuevo@example.com',
                'celular' => '9611234567',
                'password' => 'secret123',
                'password_confirmation' => 'secret123',
                'role_id' => $roles['Sembrador'] ?? 5,
            ])
            ->assertRedirect(route('usuarios.create'));

        $this->assertDatabaseHas('users', ['email' => 'nuevo@example.com']);
    }
}
