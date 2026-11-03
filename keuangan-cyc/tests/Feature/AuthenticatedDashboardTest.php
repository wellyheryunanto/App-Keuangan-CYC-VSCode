<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticatedDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login_from_dashboard(): void
    {
        $response = $this->get(route('dashboard'));

        $response->assertRedirect(route('login'));
    }

    public function test_director_with_dashboard_permission_can_view_dashboard(): void
    {
        $this->seed(RolePermissionSeeder::class);
        $director = User::factory()->create();
        $director->assignRole('direktur');

        $response = $this->actingAs($director)->get(route('dashboard'));

        $response->assertOk()
            ->assertViewIs('dashboard')
            ->assertSee($director->name);
    }

    public function test_authenticated_user_without_dashboard_permission_is_forbidden(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertForbidden();
    }
}
