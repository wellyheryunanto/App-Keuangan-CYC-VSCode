<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_is_rendered_in_indonesian(): void
    {
        $response = $this->get(route('login'));

        $response->assertOk()
            ->assertViewIs('auth.login')
            ->assertSee('Masuk ke akun Anda');
    }

    public function test_active_director_can_log_in(): void
    {
        $this->seed(RolePermissionSeeder::class);
        $password = 'Secure-Test-Password-123';
        $director = User::factory()->create(['password' => $password]);
        $director->assignRole('direktur');

        $response = $this->post(route('login'), [
            'email' => $director->email,
            'password' => $password,
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($director);
        $this->assertNotNull($director->fresh()->last_login_at);
    }

    public function test_inactive_user_cannot_log_in(): void
    {
        $password = 'Secure-Test-Password-123';
        $user = User::factory()->create([
            'password' => $password,
            'is_active' => false,
        ]);

        $response = $this->from(route('login'))->post(route('login'), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect(route('login'))
            ->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_public_registration_is_disabled(): void
    {
        $response = $this->get('/register');

        $response->assertNotFound();
    }
}
