<?php

declare(strict_types=1);

namespace Tests\Feature\Authorization;

use App\Enums\RoleName;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class RoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Route::middleware(['web', 'auth', 'role:ADMINISTRATOR'])
            ->get('/__test/admin-only', fn () => response('ok'));
    }

    public function test_administrator_can_access_administrator_route(): void
    {
        $role = Role::create([
            'name' => RoleName::ADMINISTRATOR->value,
        ]);

        $user = User::factory()->create([
            'role_id' => $role->id,
        ]);

        $this->actingAs($user)
            ->get('/__test/admin-only')
            ->assertOk()
            ->assertSee('ok');
    }

    public function test_regular_user_can_not_access_administrator_route(): void
    {
        $role = Role::create([
            'name' => RoleName::USER->value,
        ]);

        $user = User::factory()->create([
            'role_id' => $role->id,
        ]);

        $this->actingAs($user)
            ->get('/__test/admin-only')
            ->assertForbidden();
    }

    public function test_user_without_role_can_not_access_administrator_route(): void
    {
        $user = User::factory()->create([
            'role_id' => null,
        ]);

        $this->actingAs($user)
            ->get('/__test/admin-only')
            ->assertForbidden();
    }
}